<?php
	//app/models/Group.php

	class Group extends Eloquent
	{
		public function nerds()
		{
			return $this->belongsToMany('Nerd', 'nerds_groups', 'group_id', 'nerd_id');
		}
	}
	