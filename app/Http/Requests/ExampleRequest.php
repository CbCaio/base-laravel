<?php

namespace BaseLaravel\Http\Requests;

use Illuminate\Http\Request as HttpRequest;

class ExampleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param HttpRequest $request
     * @return array
     */
    public function rules(HttpRequest $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'code' => 'exists:examples,codeValue'
        ];

        // Builds at least one rule for the item 0
        $this->buildRulesItems(0,$rules);

        $items = $request->get('items',[]);

        // To make sure if an array
        $items = !is_array($items) ? [] : $items;

        // If there are more items the function will override the item 0
        foreach($items as $key => $value){
            $this->buildRulesItems($key, $rules);
        }
        return $rules;
    }

    public function buildRulesItems($key, array &$rules)
    {
        $rules["items.$key.product_id"] = 'required';
        $rules["items.$key.qtd"] = 'required';
    }
}
