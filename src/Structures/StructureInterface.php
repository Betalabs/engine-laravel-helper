<?php


namespace Betalabs\LaravelHelper\Structures;


interface StructureInterface
{
    /**
     * Fields labels
     *
     * @return array
     */
    public function labels(): array;

    /**
     * Returns translated content from select, radios and any other values
     *
     * @return array
     */
    public function translations(): array;

    /**
     * Validation rules
     *
     * An array with all validation rules in Laravel Validation format.
     *
     * There is a difference between Laravel Validation exists rule and the
     * expected exists rule in this structure. In Laravel Validation the exits
     * rule must match the table name, in the structure the API is expected.
     *
     * For example: exists:nfe_ncms,id is the Laravel Validation rule, in
     * this structure it must be exists:nfe-ncms,id. The nfe-ncms is the route
     * to NfeNcm model.
     *
     * @return array
     */
    public function rules(): array;

    /**
     * All validation messages
     *
     * @return array
     */
    public function validations(): array;

    /**
     * Relations routes
     *
     * Provide all relations routes with id and identified name for form
     *
     * @return array
     */
    public function routes(): array;

    /**
     * Formatting fields from exhibition types
     *
     * @return array
     */
    public function formats(): array;

    /**
     * Structure expected for selects
     *
     * This structure expects an array with a single position: exhibition. It
     * must be a string. The variables must be between brackets, the rest of
     * the string is considered as it is.
     *
     * For instance:
     * [
     *      'exhibition' => '{name} - {description}'
     * ]
     *
     * So if there is a record like: name = 'Beta' and description = 'Labs'
     * the exhibition will be: 'Beta - Labs'.
     *
     * @return array
     */
    public function selectable(): array;

    /**
     * Returns extra forms to be rendered with specific
     * layer like modals or popups
     *
     * @return array
     */
    public function extraForms(): array;

    /**
     * Columns available for import process
     *
     * @return array
     */
    public function importable(): array;

    /**
     * Layout boxes for better organization
     *
     * @return array
     */
    public function boxes(): array;

    /**
     * Columns available for listing
     *
     * @return array
     */
    public function columns(): array;

    /**
     * Fields dynamically added after an specified HTML event
     *
     * @return array
     */
    public function dynamic(): array;

    /**
     * Reports field
     *
     * @return array
     */
    public function reports();

    /**
     * With value to show field object
     *
     * @return array
     */
    public function with();

    /**
     * Make a menu
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Return a Json representation of this object
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0);
}