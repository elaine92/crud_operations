<?php

	// app/models/Nerd.php

    class Nerd extends Eloquent
    {
    	public function groups()
    	{
    		return $this->belongsToMany('Group', 'nerds_groups', 'nerd_id', 'group_id');
    	}
    }
    