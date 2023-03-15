<?php

declare(strict_types=1);
/**
 * /src/Form/FormMetadata.php.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */

namespace SuppCore\AdministrativoBackend\Form;

use SuppCore\AdministrativoBackend\Form\Annotations\Field as FieldAnnotation;
use SuppCore\AdministrativoBackend\Form\Annotations\Form as FormAnnotation;

/**
 * Class FormMetadata.
 *
 * @author Advocacia-Geral da União <supp@agu.gov.br>
 */
class FormMetadata
{
    /**
     * @var FormAnnotation;
     */
    protected FormAnnotation $form;

    /**
     * @var FieldAnnotation[]
     */
    protected array $fields = [];

    /**
     * @param FormAnnotation $form
     *
     * @return $this
     */
    public function setForm(FormAnnotation $form): self
    {
        $this->form = $form;

        return $this;
    }

    /**
     * @return FormAnnotation
     */
    public function getForm(): FormAnnotation
    {
        return $this->form;
    }

    /**
     * @param FieldAnnotation $field
     *
     * @return FormMetadata
     */
    public function addField(FieldAnnotation $field): self
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * @return FieldAnnotation[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}
