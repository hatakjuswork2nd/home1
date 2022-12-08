<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Message extends Component

    {
        // ここから編集した部分
        public $message;
    
        public function __construct($message)
        {
            $this->message = $message;//message-変数
        }
    
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.message');
    }
}
