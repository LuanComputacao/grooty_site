<?php

namespace Controllers;

use Kernel\mvcs\{Controller, View};
use Services\FaqService;

class HomeController extends Controller
{
    
    function get()
    {
        $faqService = new FaqService();
        header("Access-Control-Allow-Origin: *");
        
        View::render('index', [
            'title' => 'Home',
            'company_name' => 'Target Clock',
            'assistant_name' => $faqService->getAssistantName(),
            ]);
        }
        
    }