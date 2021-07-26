<?php

namespace App\Http\Controllers;

use App\Carro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        $carros = Carro::query()->orderBy('id', 'desc')->paginate(10);

        return view('home', compact('carros'));
    }


   
    
    

    public function getCarros(Request $request)
    {
        $resultado = file_get_contents('https://www.questmultimarcas.com.br/estoque' . "?termo=" . $request->termo);

        preg_match_all('#<h2 class="card__title ui-title-inner"><a href="(.*?)">([\s\S]*?)<\/a><\/h2>#s', $resultado, $titleLinks);
        preg_match_all('#<span class="card-list__info">\\r\\n([\s\S]*?)<\/span>#s', $resultado, $descricao);

        $detalhes = array_chunk($descricao[1], 6);

        $result = array_map(null, $titleLinks[1], $titleLinks[2], $detalhes);

        $item = [];
        foreach ($result as $value) {
            $item[] = array(
                "url" => $value[0],
                "nome" => $value[1],
                "ano" => trim($value[2][0]),
                "quilometragem" => trim($value[2][1]),
                "combustivel" => trim($value[2][2]),
                "cambio" => trim($value[2][3]),
                "portas" => trim($value[2][4]),
                "cor" => trim($value[2][5]),
                "user_id" => Auth::user()->id
            );
        }

        if (sizeof($item) == 0) {
            return redirect()->route('welcome')->with('error', 'Nenhum veiculo existente !!');

        }


        Carro::query()->insert($item);

        return redirect()->route('welcome')->with('sucess', 'Veiculos capturados com sucesso !!');

    }

    public function delete($id)
    {
        Carro::query()->find($id)->delete();
        return redirect()->route('welcome')->with('sucess', 'Registro Apagado com Sucesso!');
    }
}
