<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public function index() {
        $persons = Person::all();
        return view('person', compact('persons'));
    }

    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $person->delete(); 
        return redirect()->route('person.index');
    }

}
