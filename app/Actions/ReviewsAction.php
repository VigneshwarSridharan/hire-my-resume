<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;
use App\Review;

class ReviewsAction extends AbstractAction {

    public function getTitle() {
        return ' Reviews';
    }

    public function getIcon() {
        return 'voyager-bubble';
    }

    public function getPolicy() {
        return 'read';
    }

    public function getAttributes() {
        // $reviews = Review::where('post_id','=',$this->data->id)->get()->toArray();
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
            'style' => $this->data->status == 'NOT_RATED' ? '' : 'display: none'
        ];
    }

    public function getDefaultRoute() {
        return url('/admin/resumes/'.$this->data->id.'/reviews');
    }

    public function shouldActionDisplayOnDataType() {
       
        return $this->dataType->slug == 'resumes';
    }

}