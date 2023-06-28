<?php

namespace App\Http\Controllers;

use App\Events\DiagramaSent;
use App\Models\Diagrama;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\User_diagrama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiagramaController extends Controller
{
    public function index(Proyecto $proyecto)
    {
        $diagramas = $proyecto->diagramas()->paginate(4);
        return view('diagramas.index', compact('diagramas', 'proyecto'));
    }

    public function misDiagramas()
    {
        $diagramas = Auth::user()->misDiagramas()->paginate(3);
        return view('diagramas.misdiagramas', compact('diagramas'));
    }

    public function diagramar(Diagrama $diagrama)
    {
        $proyecto = $diagrama->proyecto;
        $permiso = Auth::user()->user_diagramas()->where('diagrama_id', $diagrama->id)->first();
        $permiso = $permiso->editar;
        $Class = [
            'x'=>10,
            'y'=>10,
                  'width' => 90,
                  'height' => 90,
                  'name' => 'Class',
                  'attributes' => ['atributo1', 'atributo2'],
                  'methods' => ['metodo1()', 'metodo2()']
              ];
            
        return view('diagramas.diagramar', compact('diagrama', 'proyecto', 'permiso'))->with('Class', $Class);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'descripcion' => ['required'],
            
        ]);
        try {
            $diagrama = new Diagrama();
            $diagrama->nombre = $request->nombre;
            $diagrama->descripcion = $request->descripcion;
           
            $diagrama->user_id = Auth::user()->id;
            $diagrama->proyecto_id = $request->proyecto_id;
            if ($request->diagrama_id != 'nuevo') {
                $newDiagram = Diagrama::find($request->diagrama_id);
                $diagrama->contenido = $newDiagram->contenido;
            } else {
                $diagrama->contenido = '';
            }
            $diagrama->save();
            DB::table('user_diagramas')->insert([
                'user_id' => $diagrama->user_id,
                'diagrama_id' => $diagrama->id
            ]);
            return redirect()->route('diagramas.index', $request->proyecto_id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error' . $e->getMessage());
        }
    }

    public function editor(Request $request)
    {
        $user = User::find($request->input('id'));
        $relacion = $user->user_diagramas()->where('diagrama_id', $request->input('diagrama'))->first();
        $relacionv = User_diagrama::find($relacion->id);
        $relacionv->editar = $relacionv->editar == 0 ? 1 : 0;
        $relacionv->update();
        return response()->json(['mensaje' => 'Usuario desactivado...'], 200);
    }

    public function favorito(Request $request)
    {
        $diagrama = Diagrama::findOrFail($request->input('id'));
        $diagrama->favorito = $diagrama->favorito == 0 ? 1 : 0;
        $diagrama->update();
        return response()->json(['mensaje' => 'Usuario desactivado...'], 200);
        /* return  redirect()->back()->with('message', 'Se reitro de favoritos '); */
    }

    public function terminado(Request $request)
    {
        $diagrama = Diagrama::findOrFail($request->input('id'));
        $diagrama->terminado = $diagrama->terminado == 0 ? 1 : 0;
        $diagrama->update();
        return response()->json(['mensaje' => 'Usuario desactivado...'], 200);
        /* return  redirect()->back()->with('message', 'Se reitro de favoritos '); */
    }

    public function guardar(Request $request)
    {
        $diagrama = Diagrama::findOrFail($request->input('id'));
        $diagrama->contenido = $request->input('contenido');
        $diagrama->update();
        broadcast(new DiagramaSent($diagrama))->toOthers();
        return response()->json(['msm' => 'msmsms'], 200);
    }

    public function edit(Diagrama $diagrama)
    {
        return view('diagramas.edit', compact('diagrama'));
    }

    public function update(Request $request, Diagrama $diagrama)
    {
        try {
            $diagrama->nombre = $request->nombre;
            $diagrama->descripcion = $request->descripcion;
            $diagrama->tipo = $request->tipo;
            /* dd($request->url); */
            /* dd($diagrama->contenido); */
            $fp = fopen($request->url, "r");
            $text = "";
            $linea = "";
            while (!feof($fp)) {
                $diagrama->contenido = fgets($fp);
            }
            $diagrama->update();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error' . $e->getMessage());
        }
        return redirect()->route('diagramas.index', $diagrama->proyecto_id)->with('message', 'Se edito la inf del diagrama de manera correcta');
    }

    public function usuarios(Diagrama $diagrama)
    {
        $usuarios = $diagrama->proyecto->usuarios;
        return view('diagramas.usuarios', compact('diagrama', 'usuarios'));
    }

    public function agregar(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                DB::table('user_diagramas')->insert([
                    'user_id' => $request->user_id,
                    'diagrama_id' => $request->diagrama_id
                ]);
            });
            DB::commit();
            return redirect()->back()->with('message', 'Se agrego el usuario correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ha ocurrido un error' . $e->getMessage());
        }
    }

    public function banear(Request $request, Diagrama $diagrama)
    {
        try {
            $user = User::find($request->user_id);
            $relacion = Auth::user()->user_diagramas()->where('diagrama_id', $diagrama->id)->first();
            $rel = User_diagrama::find($relacion->id);
            $rel->delete();
            return redirect()->back()->with('message', 'Se removio al usuario del diagrama: ' . $diagrama->nombre);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error' . $e->getMessage());
        }
    }

    public function descargar(Diagrama $diagrama)
    {
        $nombre = $diagrama->nombre;
        $contenido = json_decode($diagrama->contenido);

        $cell = $contenido->cells;
       //dd($cell);

       $sql='';
       $sql = 'create database ' .$nombre. ';'.PHP_EOL.' use ' .$nombre. ';'.PHP_EOL.PHP_EOL;
       
        $path = 'script.sql';
        $th = fopen("script.sql", "w");
        fclose($th);
        $ar = fopen("script.sql", "a") or die("Error al crear");
        fwrite($ar, $sql);
        fclose($ar);
        return response()->download($path);
    }

  
}
