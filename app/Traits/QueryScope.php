<?php 

namespace App\Traits;

trait QueryScope {
    public function scopeRelationCount($query, $relation) {
        if(!empty($relation)) {
            foreach($relation as $item) {
                $query->withCount($item);
            }
        }
        return $query;
    }
    public function scopeKeyword($query, $keyword, $fieldSearch = ['name']) {
        if(!empty($keyword)) {
            if(count($fieldSearch)) {
                foreach($fieldSearch as $key => $value) {
                    $query->orWhere($value, 'LIKE', '%' . $keyword . '%' );
                }
            }
        }
    }
    public function scopePublish($query, $publish) {
        if(!empty($publish) && $publish != 0) {
            $query->where('publish', '=', $publish);
        }
    }
}