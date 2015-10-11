<div class="button-group-wrapper" data-spy="affix" data-offset-top="66">
	<div class="col-xs-6">
		<div class="input-group">
			<div class="input-group-addon"><span class="glyphicon glyphicon-search" style="margin-right:0px"></span></div>
			<input type="text" class="form-control" id="search" v-model="searchKeyword" placeholder="Keyword" tabindex="1">
		</div>
	</div>
</div>
<div class="list-group main-container">
	<li class="list-group-item list-group-header">
		<span class="file_folder_name">
			<a href="#" v-on="click: sortBy('name', $event)" tabindex="{{ filesfolders.length+2 }}">File/Folder Name <i v-if="sortKeyActive('name')" v-class="fa-sort-alpha-asc: !reverse, fa-sort-alpha-desc: reverse" class="fa"></i></a>
		</span>
		<div class="file_folder_info pull-right">
			<span class="sugar" v-if="anySugarInstances()">
				<span class="version">
					<a href="#" v-on="click: sortBy('sugar_sort_version', $event)" tabindex="{{ filesfolders.length+3 }}">Sugar Version <i v-if="sortKeyActive('sugar_sort_version')" v-class="fa-sort-numeric-asc: !reverse, fa-sort-numeric-desc: reverse" class="fa"></i></a>
				</span>
				<span class="flavor">Sugar Edition</span>
				<span class="build">Sugar Build</span>
			</span>
			<span class="file_folder_size">
				<a href="#" v-on="click: sortBy('size.plain', $event)" tabindex="{{ filesfolders.length+4 }}">File Size <i v-if="sortKeyActive('size.plain')" v-class="fa-sort-numeric-asc: !reverse, fa-sort-numeric-desc: reverse" class="fa"></i></a>
			</span>
			<span class="file_folder_perm">
				<a href="#" v-on="click: sortBy('perm.plain', $event)" tabindex="{{ filesfolders.length+5 }}">Perm  <i v-if="sortKeyActive('perm.plain')" v-class="fa-sort-numeric-asc: !reverse, fa-sort-numeric-desc: reverse" class="fa"></i></a>
			</span>
			<span class="file_folder_mtime">
				<a href="#" v-on="click: sortBy('mtime.plain', $event)" tabindex="{{ filesfolders.length+6 }}">Last Modified  <i v-if="sortKeyActive('mtime.plain')" v-class="fa-sort-amount-asc: !reverse, fa-sort-amount-desc: reverse" class="fa"></i></a>
			</span>
		</div>
	</li>
	<a v-repeat="levelUp" href="{{ '/?current_path='+relative_path | getLink  }}" class="list-group-item hide" v-class="hide: false" tabindex="{{ filesfolders.length+1 }}">
		<span class="glyphicon fa fa-level-up fa-lg" aria-hidden="true" style="margin-left:5px;"></span>
		<span class="file_folder_name">Level Up</span>
		<div class="file_folder_info pull-right">
			<span class="file_folder_size">&nbsp;</span>
			<span class="file_folder_perm">&nbsp;</span>
			<span class="file_folder_mtime">&nbsp;</span>
		</div>
	</a>
	<a v-repeat="filesfolders | filterBy searchKeyword in 'name' 'perm.formated' 'mtime.formated' 'sugar.version' 'sugar.flavor' | orderBy sortKey reverse" href="{{ is_dir && !has_index_php || name == '..' ? '/?current_path='+relative_path : relative_path | getLink  }}" class="list-group-item hide" v-class="hide: false" tabindex="{{ $index+1 }}">
		<span v-if="name == '..'" class="glyphicon fa fa-level-up fa-lg" aria-hidden="true" style="margin-left:5px;"></span>
		<img  v-if="sugar && name != '..'" class="sugar_logo" src="assets/img/sugar_logo.svg">
		<span v-if="is_dir && name != '..' && !sugar" class="glyphicon fa fa-folder fa-lg" aria-hidden="true"></span>
		<span v-if="!is_dir && !sugar"class="glyphicon fa fa-file-o fa-lg" aria-hidden="true"></span>
		<span class="file_folder_name">{{ name == '..' ? 'Level Up' : name }}</span>
		<span v-if="name != '..' && has_index_php" class="glyphicon fa fa-search s_link browse_folder" title="Browse the folder" aria-hidden="true"></span>
		<span v-if="editable && !is_dir" class="glyphicon fa fa-pencil-square-o s_link go_to_editor" title="Open in Editor" aria-hidden="true"></span>
		<div class="file_folder_info pull-right">
			<span class="sugar" v-if="sugar">
				<span class="version">{{ sugar.version }}</span>
				<span class="flavor">{{ sugar.flavor }}</span>
				<span class="build">{{ sugar.build }}</span>
			</span>
			<span class="file_folder_size" data="{{ size.plain }}">{{ is_dir ? '&nbsp;' : size.formated }}</span>
			<span class="file_folder_perm" data="{{ perm.plain }}">{{ perm.formated }}</span>
			<span class="file_folder_mtime" data="{{ mtime.plain }}">{{ mtime.formated }}</span>
		</div>
	</a>
</div>
