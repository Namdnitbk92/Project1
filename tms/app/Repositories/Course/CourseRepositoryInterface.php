<?php

namespace App\Repositories\Course;

interface CourseRepositoryInterface {

	/**
     * display list 
     *
     * @return \Illuminate\Http\Response
     */
	public function all();

	public function getDataPaginate();

	/**
     * show specificed object detail
     *
     * @return \Illuminate\Http\Response
     */
	public function show($id); 

	/**
     * show the form create new instance
     *
     * @return \Illuminate\Http\Response
     */
	public function create(); 

	/**
     * Save new data after edit
     *
     * @return \Illuminate\Http\Response
     */
	public function update($data = [], $id);

	/**
     * Remove data specificed
     *
     * @return \Illuminate\Http\Response
     */
	public function delete($args = []);

    public function destroy($id);

	/**
     * Store new data created in create form
     *
     * @return \Illuminate\Http\Response
     */
	public function store($data); 

	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id);

}
