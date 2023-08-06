<?php
namespace App\Http\Controllers;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersProductOptions implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $val = $value;
        if(gettype($value) == 'array') {
            $val = join(',', $value);
        }
        

        $options = explode(';', $val);

        foreach ($options as $option) {
            echo "option: $option";
        }
        
        $options_info = array();
        foreach ($options as $option) {
            $variants =  explode(',', $option);

            if(sizeof($variants) > 0) {
                $options_info[] = $variants;
            }
            else {
                $options_info[] = array($option);
            }
        }

        foreach($options as $option) {
            $option = explode(',', $option);
            $query->whereIn('option1', $option)
            ->orWhereIn('option2', $option);
        }

        return $query;
        
    }
}