<?php

	function f_val($name = null , $overwriteValue = '')
	{
		$form_values = $_SESSION['LAST_FORM_POST_VALUES'] ?? '';

		// dd($form_values);
		
		if(is_null($name))
			return $form_values;

		if( !empty($form_values) )
			return $form_values[$name] ?? $overwriteValue;

		return $overwriteValue;
	}


	function f_clean()
	{
		unset($_SESSION['LAST_FORM_POST_VALUES']);
	}


	function f_preserve()
	{
		$session_name  = 'LAST_FORM_POST_VALUES';

		if( isset($_POST) )
			$_SESSION[$session_name] = $_POST;
	}

	function f_text($name , $inputValue = null , $attributes = null)
	{
		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);
		$value = f_val($name , $inputValue);

		return <<<EOF
			<input type="text" name="{$name}"
				value="$value" $attributes>
		EOF;
	}

	function f_number($name , $inputValue = null , $attributes = null)
	{
		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);
		$value = f_val($name , $inputValue);

		return <<<EOF
			<input type="number" name="{$name}"
				value="$value" $attributes>
		EOF;
	}


	function f_checkbox($name , $value = null, $attributes = null)
	{
		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);

		return <<<EOF
			<input type="checkbox" name="{$name}" value="{$value}" {$attributes} />
		EOF;
	}

	function f_email($name , $value = null , $attributes = null)
	{
		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);

		$value = f_val($name , $inputValue);

		return <<<EOF
			<input type="email" name="{$name}"
				value="$value" $attributes>
		EOF;
	}

	function f_password($name , $value = null , $attributes = null , $preservePassword = false)
	{
		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);

		$value = f_val($name , $inputValue);

		if(!$preservePassword)
			$value = '';
		
		return <<<EOF
			<input type="password" name="{$name}"
				value="$value" $attributes>
		EOF;
	}


	function f_textarea($name , $inputValue = null , $attributes = null)
	{
		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);

		$value = f_val($name , $inputValue);

		return <<<EOF
			<textarea name="{$name}" $attributes>$value</textarea>
		EOF;
	}

	function f_label($html , $for = null, $attributes = null)
	{
		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);

		$html = ucwords($html);

		return <<<EOF
			<label {$attributes} for="{$for}">
				{$html}
			</label>
		EOF;
	}

	function f_date($name , $inputValue = null , $attributes = null)
	{
		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);
		$value = f_val($name , $inputValue);

		return <<<EOF
			<input type="date" name="{$name}"
				value="$value" $attributes>
		EOF;
	}

	function f_submit($name , $value = null , $attributes = null)
	{
		if(is_null($attributes))
		{
			$attributes = [];
			$attributes['class'] = 'btn btn-primary btn-sm';
		}

		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);
		$value = is_null($value) ? "Submit" : $value;

		
		return <<<EOF
			<input type="submit" name="{$name}"
				value="$value" $attributes>
		EOF;
	}

	function f_col($label , $input)
	{
		$label = f_label($label);
		return <<<EOF
			{$label} {$input}
		EOF;
	}

	function f_open(array $attributes , $enctype = false)
	{
		if(!isset($attributes['method']))
			$attributes['method'] = 'post';

		if( isset($attributes['url']))
			$attributes['action'] = $attributes['url'];

		if( $enctype )
			$attributes['enctype'] = 'multipart/form-data';

		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);

		return <<<EOF
			<form $attributes>
		EOF;
	}


	function f_close()
	{
		return <<<EOF
			</form>
		EOF;
	}

	function f_file($name, $attributes = null)
	{
		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);

		return <<<EOF
			<input type="file" name="{$name}" $attributes>
		EOF;
	}

	function f_hidden($name , $value = null , $attributes = null)
	{
		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);

		return <<<EOF
			<input type="hidden" name="{$name}"
				value="$value" $attributes>
		EOF;
	}

	function f_select($name , $values , $selected = null, $attributes = null)
	{
		$isAssoc = is_assoc($values);

		$attributes = is_null($attributes) ? $attributes : keypairtostr($attributes);

		$options = '';

		$selected = f_val($name , $selected);

		foreach($values as $key => $value)
		{
			$select = '';

			if($isAssoc)
			{
				if(! is_null($selected)) 
				{
					if( isEqual( $key , $selected ) )
						$select = 'selected';
				}

				if(!empty($value)){
					$options .= "<option value='{$key}' {$select}> {$value} </option>";
				}
				
			}else{
				if(! is_null($selected)) {

					if(strtolower($value) == strtolower($selected)){
						$select = 'selected';
					}
				}

				if(!empty($value)){
					$options .= "<option value='{$value}' {$select}> {$value}</option>";
				}
				
			}
		}

		return <<<EOF
			<select name = "{$name}" {$attributes}>
				<option value=''>--Select</option>
				{$options}
			</select>
		EOF;
	}

	function f_attributes()
	{
		return [
			'class' => 'form-control',
			'autocomplete' => 'off'
		];
	}
?>