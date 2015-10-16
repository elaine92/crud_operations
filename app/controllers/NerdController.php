<?php

class NerdController extends \BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//get all the nerds
		$nerds = Nerd::all();

		//load the view make and pass the nerds
		return View::make('nerds.index')
			->with('nerds', $nerds);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Get the group option
		$group_options = Group::where('active', '=', 1)->lists('group_name', 'id');
		/*print_r($group_options);
		exit();*/

		//Load the create form (app/views/nerds/create.blade.php)
		return View::make('nerds.create')
			->with('group_options', $group_options);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//validate
		// more information at:=> http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'nerd_level' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return Redirect::to('nerds/create')
                ->withErrors($validator)
                ->withInput(Input::all());
                //->withInput(Input::except('password'));
        } else {
            // store
            /*print_r(Input::get('groups'));
            exit;*/
            $nerd = new Nerd;
            $nerd->name       = Input::get('name');
            $nerd->email      = Input::get('email');
            $nerd->nerd_level = Input::get('nerd_level');
            $nerd->save();
            $nerd->groups()->attach(Input::get('groups'));

            // redirect
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to('nerds');
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//get the nerd
		$nerd = Nerd::find($id);

		//show the view and pass the nerd to it
		return View::make('nerds.show')
			->with('nerd', $nerd);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//get the nerd
		$nerd = Nerd::find($id);
		$group_options = Group::where('active', '=', 1)->lists('group_name', 'id');

		//show the edit view and pass the nerd to it
		return View::make('nerds.edit')
			->with('nerd', $nerd)
			->with('group_options', $group_options);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'nerd_level' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('nerds/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $nerd = Nerd::find($id);
            //echo("<pre>");print_r(Input::all());exit();
            $nerd->name       = Input::get('name');
            $nerd->email      = Input::get('email');
            $nerd->nerd_level = Input::get('nerd_level');
            $nerd->save();

            if (!is_null(Input::get('groups'))) {
	            $nerd->groups()->sync(Input::get('groups'));
            }

            // redirect
            Session::flash('message', 'Successfully updated nerd!');
            return Redirect::to('nerds');
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		 // delete
        $nerd = Nerd::find($id);
        $nerd->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to('nerds');
	}
}
