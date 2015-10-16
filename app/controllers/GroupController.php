<?php
//app/controllers/GroupController.php

class GroupController extends \BaseController 
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//get all the groups
		$groups = Group::all();

		//load the view make and pass the groups
		return View::make('groups.index')
			->with('groups', $groups);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//load the create form
		return View::make('groups.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
            'group_name'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return Redirect::to('groups/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            // store
            $group = new Group;
            $group->group_name = Input::get('group_name');
            $group->active = Input::has('active');
            $group->save();

            // redirect
            Session::flash('message', 'Successfully created group!');
            return Redirect::to('groups');
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
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the group
        $group = Group::find($id);

        // show the edit form and pass the group
        return View::make('groups.edit')
            ->with('group', $group);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
            'group_name' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return Redirect::to('groups/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            // store
            $group = Group::find($id);
            $group->group_name = Input::get('group_name');

            $nerds = Group::find($group->id)->nerds->count();

            if ($nerds) {
            	Session::flash('message', 'This group cannot be inactivated since it has Nerds!');
            	return Redirect::to('groups');
            }
            $group->active = Input::has('active');
            $group->save();

            // redirect
            Session::flash('message', 'Successfully updated group!');
            return Redirect::to('groups');
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
	    //delete group
		$group = Group::find($id);
		$nerds = Group::find($group->id)->nerds->count();
		//print($nerds);

		if (empty($nerds)) {
			$group->delete();

			// redirect
	        Session::flash('message', 'Successfully deleted the group!');
	        return Redirect::to('groups');
	        
		} else {
			Session::flash('message', 'This group cannot be deleted!');
       		return Redirect::to('groups');
		}
	}

}
