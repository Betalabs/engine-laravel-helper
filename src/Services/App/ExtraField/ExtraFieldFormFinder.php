<?php


namespace Betalabs\LaravelHelper\Services\App\ExtraField;


class ExtraFieldFormFinder
{
    /**
     * @param $form
     * @param string $label
     * @return bool|mixed
     */
    public function findByLabel($form, string $label)
    {
        if (!empty($form->extra_fields)) {
            return collect($form->extra_fields)->filter(function ($extraField) use($label) {
                return $extraField->label == $label;
            })->first();
        }

        return false;
    }
}