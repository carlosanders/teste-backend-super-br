<?php

declare(strict_types=1);
/**
 * /src/Form/FormMapper.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Form;

use Doctrine\Common\Annotations\AnnotationException;
use ReflectionException;
use SuppCore\AdministrativoBackend\Form\Annotations\Form as FormAnnotation;
use SuppCore\AdministrativoBackend\Form\Annotations\Method;
use SuppCore\AdministrativoBackend\Form\Driver\AnnotationsDriver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class FormMethod.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class FormMapper
{
    /**
     * @param FormFactoryInterface          $factory
     * @param AnnotationsDriver             $annotationDriver
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        private FormFactoryInterface $factory,
        private AnnotationsDriver $annotationDriver,
        private AuthorizationCheckerInterface $authorizationChecker,
    ) {
    }

    /**
     * @param string $dtoClass
     * @param string $method
     *
     * @return FormInterface
     *
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function buildForm(string $dtoClass, string $method): FormInterface
    {
        $formMetatada = $this->getForm($dtoClass);

        switch ($method) {
            case 'createMethod':
                $httpMethod = 'POST';
                break;
            case 'updateMethod':
                $httpMethod = 'PUT';
                break;
            default:
                $httpMethod = 'PATCH';
                break;
        }

        // default value
        if (empty($formMetatada->validationGroups)) {
            $formMetatada->validationGroups = [$method, 'Default'];
        }

        // Create form, load possible entity data for form and handle request
        $form = $this->factory->createNamed(
            '',
            FormType::class,
            null,
            [
                'data_class' => $dtoClass,
                'validation_groups' => $formMetatada->validationGroups,
                'method' => $httpMethod,
                'allow_extra_fields' => true,
            ]
        );

        $fields = $this->getFields($dtoClass, $method);

        foreach ($fields as $field) {
            $form->add($field->name, $field->value, $field->options);
        }

        return $form;
    }

    /**
     * @param string $dtoClass
     *
     * @return FormAnnotation
     *
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function getForm(string $dtoClass): FormAnnotation
    {
        return $this->annotationDriver->getMetadata($dtoClass)->getForm();
    }

    /**
     * @param string $dtoClass
     * @param string $method
     *
     * @return array
     *
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function getFields(string $dtoClass, string $methodName): array
    {
        $fields = [];
        foreach ($this->annotationDriver->getMetadata($dtoClass)->getFields() as $field) {
            if (empty($field->methods)) {
                // qualquer method
                $fields[] = $field;
            } else {
                // liberado para o method?
                /** @var Method $method */
                foreach ($field->methods as $method) {
                    // método existe
                    if ($method->value === $methodName) {
                        if (empty($method->roles)) {
                            // qualquer role para esse method
                            $fields[] = $field;
                            break;
                        }
                        /** @var string $role */
                        foreach ($method->roles as $role) {
                            if ($this->authorizationChecker->isGranted($role)) {
                                // usuario tem acesso ao method
                                $fields[] = $field;
                                break;
                            }
                        }
                    }
                }
            }
        }

        return $fields;
    }
}
