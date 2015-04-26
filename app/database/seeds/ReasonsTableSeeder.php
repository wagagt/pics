<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class ReasonsTableSeeder extends Seeder {

	public function run()
	{

			Reasons::create(array(
				'name'			=>	'Aprobado Default',
				'description'	=>	'Aprobado Default',
				'text'			=>	'Aprobado Default',
				'type'			=>	'product',
				'active'		=>	1,
			));

			Reasons::create(array(
				'name'			=>	'Denegado-Contenido-Duplicado',
				'description'	=>	'Denegado por duplicar producto',
				'text'			=>	'Denegado por existir un producto identico',
				'type'			=>	'product',
				'active'		=>	1,
			));

			Reasons::create(array(
				'name'			=>	'Denegado-Contenido-Irrelevante',
				'description'	=>	'Denegado por no ser un producto real',
				'text'			=>	'Denegado por no ser un producto relevante para publicar',
				'type'			=>	'product',
				'active'		=>	1,
			));

			Reasons::create(array(
				'name'			=>	'Denegado-Fotografía-Errónea',
				'description'	=>	'Denegado por no tener fotografías correctas.',
				'text'			=>	'Denegado por que las fotografías no cumplen los requisitos',
				'type'			=>	'product',
				'active'		=>	1,
			));

			Reasons::create(array(
				'name'			=>	'Denegado-Información-Incompleta',
				'description'	=>	'Denegado por no tener la información completa',
				'text'			=>	'Denegado por información incompleta.',
				'type'			=>	'product',
				'active'		=>	1,
			));

			Reasons::create(array(
				'name'			=>	'Denegado-Reincidencia',
				'description'	=>	'Denegado por intentar nuevamente publicar productos denegados.',
				'text'			=>	'Denegado por reincidir en publicar material prohibido.',
				'type'			=>	'user',
				'active'		=>	1,
			));

			Reasons::create(array(
				'name'			=>	'Denegado-Admin',
				'description'	=>	'Denegado por decisión del administrador',
				'text'			=>	'Denegado por creterio del administrador',
				'type'			=>	'user',
				'active'		=>	1,
			));
	}
}
