<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\SectionPageTrait;
use App\Traits\ServiceTrait;
use App\Traits\PortfolioTrait;

class WelcomeController extends Controller
{
  use SectionPageTrait, ServiceTrait, PortfolioTrait;
}
