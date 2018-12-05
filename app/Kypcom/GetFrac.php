<?php

namespace App\Kypcom;
use App\Fraccionamiento;



class GetFrac 
{
	public get_frac()
	{
		$fraccionamientos = Fraccionamiento::select('id','fraccionamiento');

		return $fraccionamientos;
	}

}
