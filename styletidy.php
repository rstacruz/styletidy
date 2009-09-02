#!/usr/bin/php
<?php
/* StyleTidy
 * ======================================================================== */
/*
 * Page: General usage
 *
 * Usage:
 *     styletidy [OPTIONS]
 *
 *   Refer to `styletidy --help` for a detailed list of options.
 *
 * Examples:
 *   This example takes a CSS document `style.css` and cleans it up. The 
 *   clean version will be saved to `style2.css`.
 *
 *     cat style.css | styletidy preset=clean > style2.css
 *
 */
/* ======================================================================== */

class StSettings
{
    /* Page: Options
     *
     * Using options:
     *   Put them as command line arguments.
     *
     * Example:
     *   The following example will take an input file and reformats the code
     *   without the comments.
     *
     *     styletidy show_comments=0
     */

    var $defaults = array
    (
        /* Option: text_width
         *   Integer. Refers to the desired width of the entire document in
         *   characters.
         *
         * Description:
         *   Settings this to a number greater than `0` will do word-wrapping when
         *   necessary; and setting this to `0` disables word-wrapping.
         *
         * Example:
         *   Below is sample output from running
         *   `styletidy preset=singleline text_width=80`.
         *   The [[singleline]] preset defaults to a [[text_width]] of `0` (no
         *   word-wrapping), so setting [[text_width]] in this case will enable
         *   word-wrapping.
         *
         *     #results-c { width: 800px; margin: 0 auto; }
         *     #results-c h3 { overflow: hidden; border-bottom: dotted 1px #777;
         *        padding-bottom: 10px; line-height: 1.4em; }
         *     #results-c h3 strong { float: left; display: block; width: 12%;
         *        padding-right: 10px; font-size: 0.8em; text-transform: uppercase;
         *        line-height: 1.4em; padding-top: 4px; text-align: right; color: #333; }
         *     #results-c h3 span { float: left; color: #777; display: block; width: 80%;
         *        border-left: dotted 1px #777; padding-left: 10px; font-weight: normal; }
         *     #results-c h3 em { color: #666; font-style: normal; font-weight: bold; }
         *
         * [Grouped under "General options"]
         */
        'text_width' => 0,

        /* Comment options
         * ==================================================================== */
        
        /* Option: show_comments
         *   Boolean. Shows CSS comments if set to `1`, and hides them if set to `0`.
         *
         * [Grouped under "Comment options"]
         */
        'show_comments' => TRUE,

        /* Option: comment_newlines_before
         *   Integer. Refers to how many new lines to add before a comment.
         *
         * Example:
         *   Below is sample output from running `styletidy preset=singleline
         *   comment_newlines_before=2 comment_newlines_after=2`.
         *
         *     #results-c h3 span { float: left; color: #777; display: block; font-weight: normal; }
         *     #results-c h3 em { color: #666; font-style: normal; font-weight: bold; }
         *     
         *     
         *     /* Results: item * /
         *     
         *     #results .item { width: 18%; margin: 0 1%; text-align: center; float: left; }
         *     #results .item a { font-size: 1.1em; line-height: 1.3em; display: block; }
         *     #results .item a .title { display: block; }
         *
         *   Below is sample output from running `styletidy preset=singleline
         *   comment_newlines_before=0 comment_newlines_after=1`.
         *
         *     #results-c h3 span { float: left; color: #777; display: block; font-weight: normal; }
         *     #results-c h3 em { color: #666; font-style: normal; font-weight: bold; }
         *     /* Results: item * /
         *     #results .item { width: 18%; margin: 0 1%; text-align: center; float: left; }
         *     #results .item a { font-size: 1.1em; line-height: 1.3em; display: block; }
         *     #results .item a .title { display: block; }
         *
         * See also:
         * - [[comment_newlines_after]]
         *
         * [Grouped under "Comment options"]
         */
        'comment_newlines_before' => 0,

        /* Option: comment_newlines_after
         *   Integer. Refers to how many new lines to add after a comment.
         *
         * Example:
         *   See [[comment_newlines_before]] for a detailed example.
         *  
         * See also:
         * - [[comment_newlines_before]]
         *
         * [Grouped under "Comment options"]
         */
        'comment_newlines_after' => 2,

        /* Selector options
         * ==================================================================== */
        
        /* Option: selector_width
         *   Integer. Refers to the width (in characters) alloted for the selectors.
         *
         * Description:
         *   If `selector_padding` is set, How much to pad after selector ("td     ")
         *   If `selector_conservative_newline` is set, the maximum width of selectors
         *   before putting the next ones in a new line
         *
         * See also:
         * - [[selector_padding]]
         *
         * [Grouped under "Selector options"]
         */ 
        'selector_width' => 50,

        /* Option: selector_indent
         *   Integer. The number of spaces to indent lines after they have been
         *   wordwrapped. 
         *
         * [Grouped under "Selector options"]
         */
        'selector_indent' => 2,

        /* Option: selector_padding
         *   Boolean. Determines if the selectors should be padded with spaces
         *   when [[brace_style]] is set to `compact`.
         *
         *
         * Description:
         *   This only applies of [[brace_style]] is set to `compact`.
         *
         *   The end of selectors (just before the opening brace) will be
         *   padded with spaces if this is `1`, with the number of spaces determined
         *   by `selector_width`.
         *
         * Example:
         *   If `selector_padding` is set to `1` and `selector_width` is set to 20,
         *   output may look like this: 
         *
         *      #header,
         *      #search            { width: 200px; } 
         *     
         * [Grouped under "Selector options"]
         */
        'selector_padding' => FALSE,

        /* Option: selector_newline
         *   Boolean. Each selector will be newlined.
         *
         * Description:
         *   New lines in between selectors? (e.g.: "form, td" vs. "form,\ntd")
         *
         *   [[selector_conservative_newline]] will override this.
         *
         * Example:
         *   This is an example of code with selector newline.
         *
         *     /* styletidy selector_newline=0 * /
         *     #search form,
         *     #search table,
         *     #search .button span
         *        { display: none; }
         *
         * See also:
         *  - [[selector_conservative_newline]]
         *
         * [Grouped under "Selector options"]
         */
        'selector_newline' => TRUE,

        /* Option: selector_conservative_newline
         *   Boolean.
         *
         * New lines after each selector only if it's less than selector_width?
         * This helps on selectors such as "td, tr, tbody, thead" where it may look weird
         * if each element is placed on it's own line.
         *
         * [Grouped under "Selector options"]
         */
        'selector_conservative_newline' => TRUE,

        /* Option: selector_compact
         *   Boolean. Add spaces in between selectors? (e.g., "form, td" vs. "form,td")
         *
         * [Grouped under "Selector options"]
         */
        'selector_compact' => FALSE,

        /* Option: brace_style
         *   String. Defines the brace/indentation style for the document.
         *
         * Description:
         *   Valid values are `compact`, `ownline`, `ansi` and `standard` (the default).
         *
         * Standard style:
         *   When set to `standard`, the indentation follows the typical style: 
         *
         *     foo {
         *       bar
         *     }
         *
         * Own-line style:
         *   When set to `ownline`, the number of spaces that will precede each opening
         *   brace will be defined by [[definition_indent]].
         *        
         *     foo
         *     { bar }
         *
         * Compact style:
         *   When set to `compact`, ...
         *
         *     foo { bar }
         *
         * ANSI style:
         *   When set to `ansi`, ...
         *
         *     foo
         *     {
         *        bar
         *     }
         *
         * Future:
         *   In the future, `whitesmith` and `banner` will be implemented. 
         *
         * See also:
         * - [[definition_indent]]
         * - [[single_line_definitions]] (`compact` works best when this is set to `1`.)
         *
         */
        'brace_style' => 'standard',

        /* Option: definition_newlines
         *   Integer. Refers to how many new lines will be added after a definition's
         *   closing brace.
         *
         * Description:
         * Note: if set to 0, it may not work as you would expect if 'selector_width'
         * is set to anything else other than 0. The reason for this is that a word
         * wrap is forced when `selection_width` is > 0.
         *
         * [Grouped under "Definition options"]
         */
        'definition_newlines' => 2,

        /* Option: property_compact
         *   Boolean. Properties will have minimal whitespace when this is set to `1`.
         *
         * Description:
         *   Compact the properties (e.g.: "a: b; c: d" vs. "a:b;c:d")
         *
         * [Grouped under "Definition options"]
         */
        'property_compact' => FALSE,

        /* Option: single_line_definitions
         *   Boolean. Each definition will be placed on it's own line if this is set to `0`.
         *
         * Description:
         * Should definitions be all in a single line (if possible), or one on it's own line?
         * This is going to be wordwrapped according to `text_width` and `definition_indent`.
         *
         * [Grouped under "Definition options"]
         */
        'single_line_definitions' => FALSE,

        /* Option: definition_indent
         *   Integer.
         *
         * Description:
         *   How many spaces to indent the word-wrapped definitions.
         *   If `selector_padding` is on and `brace_style` is set to `compact`, then this will be adjusted
         * to account for `selector_width`.
         *
         * [Grouped under "Definition options"]
         */
        'definition_indent' => 3,

        /* Option: definition_trailing_semicolon
         *   Boolean. If set to `0`, the optional final semicolon before the closing
         *   brace will be omitted.
         *
         * [Grouped under "Definition options"]
         */
        'definition_trailing_semicolon' => TRUE,

        /* Option: brace_spaces_before
         *   Integer. Defines how many spaces will be placed before an opening brace.
         *
         * Description:
         * Describes how many spaces to place before an opening brace.
         * (e.g.: the space after the selector in `div { color: red }`)
         *
         * [Grouped under "Definition options"]
         */
        'brace_spaces_before' => 1,
    );

    /* Page: Presets
     *
     * Using presets:
     *   Try this.
     *
     *     styletidy preset=clean
     */

    var $presets = array
    (
        /* Preset: compress
         *   Compresses CSS files to have the least amount of whitespace possible.
         *
         * Example:
         *   This is an example of using `styletidy preset=compress`.
         *
         *     #search p{color:#f00;background:transparent}ul,li,ol{margin:0;padding:0}
         */
        'compress' => array
        (
            'text_width' => 0,
            'show_comments' => FALSE,
            'selector_conservative_newline' => FALSE,
            'selector_width' => 0,
            'selector_compact' => TRUE,
            'selector_newline' => FALSE,
            'property_compact' => TRUE,
            'single_line_definitions' => TRUE,
		    'definition_trailing_semicolon' => FALSE,
            'definition_newlines' => 0,
            'brace_spaces_before' => 0,
            'brace_style' => 'compact',
        ),

        /* Preset: singleline
         * Lines up rules to occupy only one line each with just enough amount of whitespace.
         *
         * Example:
         *   This is an example output of `styletidy preset=singleline`.
         *
         *     /* Results * /
         *     #results-c { width: 800px; margin: 0 auto; }
         *     #results-c h3 { overflow: hidden; border-bottom: dotted 1px #777; padding-bottom: 10px; line-height: 1.4em; }
         *     #results-c h3 strong { float: left; display: block; width: 12%; padding-right: 10px; font-size: 0.8em; text-transform: uppercase; line-height: 1.4em; padding-top: 4px; text-align: right; color: #333; }
         *     #results-c h3 span { float: left; color: #777; display: block; width: 80%; border-left: dotted 1px #777; padding-left: 10px; font-weight: normal; }
         *     #results-c h3 em { color: #666; font-style: normal; font-weight: bold; }
         *     
         *     /* Results: item * /
         *     #results .item { width: 18%; margin: 0 1%; text-align: center; float: left; }
         *     #results .item a { font-size: 1.1em; line-height: 1.3em; display: block; }
         *     #results .item a .title { display: block; }
         * 
         * Customizations:
         *   - You can conserve whitespace If [[selector_compact]] is set to `0`.  
         *     Example output: `#results-c {width:800px;margin:0 auto;}`
         */
        'singleline' => array
        (
            'comment_newlines_before' => 1,
            'comment_newlines_after' => 1,
            'text_width' => 0,
            'selector_width' => 0,
            'selector_indent' => 2,
            'selector_padding' => TRUE,
            'selector_newline' => TRUE,
            'selector_conservative_newline' => TRUE,
            'single_line_definitions' => TRUE,
            'definition_newlines' => 1,
            'brace_style' => 'compact',
        ),

        /* Preset: clean
         * A compact look with the selectors and definitions segregated into columns.
         *
         * Example:
         *   This is an example output of `styletidy preset=clean`.
         *
         *     /* Item: description * /
         *     .description             { padding-bottom: 10px; }
         *     
         *     /* Results * /
         *     #results-c               { width: 800px; margin: 0 auto; }
         *     #results-c h3            { overflow: hidden; border-bottom: dotted 1px #777; padding-bottom: 10px; line-height: 1.4em; }
         *     #results-c h3 strong     { float: left; display: block; width: 12%; padding-right: 10px; font-size: 0.8em;
         *                                text-transform: uppercase; line-height: 1.4em; padding-top: 4px; text-align: right; color: #333; }
         *     #results-c h3 span       { float: left; color: #777; display: block; width: 80%; border-left: dotted 1px #777;
         *                                padding-left: 10px; font-weight: normal; }
         *     #results-c h3 em         { color: #666; font-style: normal; font-weight: bold; }
         *
         * Recommended customizations:
         *
         *   - You may adjust [[selector_width]] to your liking.
         */
        'clean' => array
        (
            'preset' => 'singleline',
            'text_width' => 120,
            'selector_width' => 24,
        ),

        /* Preset: semicompact
         * The RSC-style
         */
        'semicompact' => array
        (
            'text_width' => 80,
            'selector_width' => 40,
            'single_line_definitions' => TRUE,
            'brace_style' => 'ownline',
        ),
    );
}


/* Class StyleTidy
 * ==================================================================== */

class StyleTidy
{
	/* Class: StyleTidy
	 * CSS parser class.
     * [Internal]
	 */

    /* Constructor
     * ==================================================================== */
    
	function StyleTidy($str, $options = array())
	{
        /* Function: StyleTidy()
         * Constructor.
         */

        // Copy over from StSettings.
        $settings = new StSettings;
        $this->options = $settings->defaults;
        $this->presets = $settings->presets;
        
		$this->css  = (string) $str;
		$this->data = $this->_parse($this->css);
    }


    /* Functions
     * ==================================================================== */
    
    function _cleanupOptions()
    {
        // If rules and definitions are in the own line, and selector_padding is on,
        // Adjust the definition_indent accordingly
        if (($this->options['selector_padding']) && ($this->options['brace_style'] == 'compact'))
            { $this->options['definition_indent'] += $this->options['selector_width']; }
	}

    function loadOptions($options = array())
    {
        /* Function: loadOptions()
         * Loads options that are in the associative array.
         *
         * Description:
         *   To be documented.
         */

        if (isset($options['preset']))
            { $this->loadPreset($options['preset']); }
    
        foreach ($this->options as $k => $v)
        {
            if (!isset($options[$k])) { continue; }
            $value = $options[$k];
            if (is_string($v)) { $value = (string) $value; }
            if (is_int($v))    { $value = (int)    $value; }
            if (is_bool($v))   { $value = (bool)   $value; }
            $this->options[$k] = $value;
        }

        return;
    }

    function loadPreset($preset = '')
    {
        /* Function: loadPreset()
         * Loads a certain preset name.
         *
         * Description:
         *   To be documented.
         */

        $preset = (string) $preset;
        if (!isset($this->presets[$preset]))
            { return; }

        $this->loadOptions($this->presets[$preset]);
        return;
    }

    function prepare()
    {
        static $f; if ($f) { return $f; }
        $f = NULL;
        $this->_cleanupOptions();
        return $f;
    }


    /* Private methods
     * ==================================================================== */
    
	function _parse($in)
	{
		/* Function: _parse()
		 * Parses.
		 */

		$comment = '/\*.*?\*/';
		$def = '{.*?}';
		$sc = 'A-Za-z0-9\-_#\.,:\[\]\(\)\*=';
		$selector = "[$sc \r\t\n]*(?={)";
		preg_match_all("~($comment)|($def)|($selector)~s", $in, $m);
		$result = array();
		$index = 0;
		for ($i = 0; $i < count($m[0]); ++$i)
		{
			$line = $m[0][$i];
			$data = trim($line);
			$item = array();

			// Comment
			if ($m[1][$i] == $line)
			{
				$item = array('type' => 'comment', 'comment' => $data); 
			}
			// Definition
			elseif ($m[2][$i] == $line)
			{
				$item = array('type' => 'definition', 'data' => array());
				preg_match('/{(.*?)}/s', $data, $xm); // remove {}
				$properties = explode(';', trim($xm[1]));
				foreach ($properties as $property)
				{
					// get <property>: <value>
					preg_match('/^\s*([a-zA-Z\-]*)/', $property, $xm1); 
					if ($xm1[1] == '') { continue; }
					preg_match('/:\s*(.*)\s*$/', $property, $xm2); 
					$item['data'][$xm1[1]] = $xm2[1];
				}
			}
			// Selector
			elseif ($m[3][$i] == $line)
			{
				$item = array('type' => 'selector', 'selectors' => array());
				$selectors = explode(',', $data);
				foreach ($selectors as $selector)
				{
					$selector = trim($selector);
					if ($selector == '') { continue; }
					preg_match_all('~(['.$sc.']+)~', $selector, $mm);
					$selector = implode(' ', $mm[0]);
					$item['selectors'][] = $selector;
				}
			}
			$result[] = $item;
		}
		return $result;
	}

	function debug()
	{
		/* Function: debug()
		 * To be documented.
		 *
		 * Description:
		 *   To be documented.
		 */
	
		var_dump($this->data);
	}

	function e($str, $width = 0, $indent = 0, $regex = '~([^\s\r\n]*)~')
	{
		/* Function: e()
	     * Echoes.
		 */

        // Do word wrapping
        if ((int) $width > 0)
        {
            preg_match_all($regex, $str, $m);
            $str = '';
            $words = $m[1];
            $caret = $this->caret;
            $i = 0;
            foreach ($words as $word)
            {
                if (trim($word) == '') { continue; }
                $first = ($i++ == 0) ? TRUE : FALSE; 
                $space = $first ? 0 : 1;

                if ($caret + $space + strlen($word) > $width)
                {
                    $caret = strlen($word) + $indent;
                    $str .= "\n" . str_repeat(' ', $indent) . $word;
                }
                else {
                    $caret += strlen($word) + $space;
                    $str .= ($space ? ' ' : '') . $word;
                }
            }
        }

        // Finally print it out
		print $str;
        $this->output .= $str;

        // Predict where the caret is.
        $e = explode("\n", $str);
        if (count($e) > 1)
            { $this->caret = strlen($e[count($e)-1]); }
        else
            { $this->caret += strlen($e[0]); }
	}

	function pad($size)
	{
		/* Function: pad()
		 * To be documented.
		 *
		 * Description:
		 *   To be documented.
		 */
	
        $size = (int) $size;
        if ($size == 0) { return; }

        $amount = $size - $this->caret;
        if ($amount <= 0) { return; }

        echo str_repeat(' ', $amount);
	}

	function printout()
	{
		/* Function: printout()
		 * To be documented.
		 *
		 * Description:
		 *   To be documented.
		 */

        // Do preparation (e.g., make sure options are all okay). This
        // will only be done once, even if printout() is called multiple
        // times.
        $this->prepare();
	
		foreach ($this->data as $line)
		{
			// Comment
			if ($line['type'] == 'comment')
			{
                if (!$this->options['show_comments'])
                    { continue; }

                if ($this->output != '')
                    { $this->e(str_repeat("\n", $this->options['comment_newlines_before'])); }

				$this->e($line['comment']);
                $this->e(str_repeat("\n", $this->options['comment_newlines_after']));
			}

			// Selector
			elseif ($line['type'] == 'selector')
			{
                // For each of the selectors...
				for ($i = 0; $i < count($line['selectors']); ++$i)
				{
					$selector = $line['selectors'][$i];
                    $first = ($i == 0) ? TRUE : FALSE; 
					$last = ($i == count($line['selectors']) - 1) ? TRUE : FALSE;

                    if (!$first)
                    {
                        if ($this->options['selector_conservative_newline'])
                        {
                            $width = $this->options['text_width'];
                            if (($this->options['selector_width'] > 0) &&
                                (($width == 0) || ($this->options['selector_width'] < $width)))
                                { $width = $this->options['selector_width']; }

                            if ($this->caret + strlen($selector) > $width)
                                { $this->e("\n"); }
                            else
                                { $this->e(" "); }
                        }

                        elseif ($this->options['selector_newline'])
                            { $this->e("\n"); }
                        elseif (!$this->options['selector_compact'])
							{ $this->e(" "); }
                    }

                    // Echo out the actual selector
                    $this->e($selector,
                        $this->options['selector_width'],
                        $this->options['selector_indent']);

                    // Echo out the mandatory selector separator
					if (!$last)
					    { $this->e(","); }
				}

                // Print the terminator of the selector.
                // Put the definitions in another line.
                if (in_array($this->options['brace_style'], array('ownline','ansi')))
                    { $this->e("\n"); }

                // Print the space here: ---v
                //                 #search p {
                elseif (in_array($this->options['brace_style'], array('standard')))
                    { $this->e(" "); }

                // If selector_padding is on, pad it with spaces at the end.
                elseif (($this->options['brace_style'] == 'compact') &&
                       ($this->options['selector_padding']))
                    { $this->pad($this->options['selector_width']); }
			}

			// Definition
			elseif ($line['type'] == 'definition')
			{
                // Print the opening brace.
                // For 'compact' and 'newline', its pretty much the same.
                // The \n for `newline` has already been accounted for by the selector.
                if (in_array($this->options['brace_style'], array('compact', 'ownline')))
                {
                    $this->e(str_repeat(' ', $this->options['brace_spaces_before']));
                    $this->e("{");
                    if (!$this->options['property_compact'])
                        { $this->e(' '); }
                }
                else {
                    $this->e("{\n");
                }

				$i = 0;
				foreach ($line['data'] as $property => $value)
				{
                    $first = ($i == 0) ? TRUE : FALSE; 
					$last = (++$i == count($line['data'])) ? TRUE : FALSE;
                    
                    // Determine the item
                    // Should it be "a:b" or "a: b"?
                    $colon = ($this->options['property_compact']) ? ':' : ': ';
                    $item = $property . $colon . $value;

                    // Draw the separators, and do the wordwrapping thing
                    if (!$first)
                    {
                        if (!$this->options['single_line_definitions'])
                            { $this->e("\n"); }

                        // If it's eligible for word wrapping
                        elseif (($this->options['text_width'] > 0) &&
                            ($this->caret + strlen($item) > $this->options['text_width']))
                        {
                            $this->e("\n"); 
                        }

                        // Separate each with a space
                        elseif (!$this->options['property_compact'])
                            { $this->e(' '); }
                    }

                    // Indent by word wrap if necessary
                    if ($this->caret == 0)
                        { $this->pad($this->options['definition_indent']); }

                    // Actually draw it
					$this->e($item);

                    // Add in the terminator; but take trailing_semi into account
                    // (i.e.: don't add the last ; if the options say so)
                    if ((!$last) || ($this->options['definition_trailing_semicolon']))
                        { $this->e(';'); }
				}

                // Print the terminator. End it.
                // Print the newline in here: ------------v
                //            #search p {\n   (definition)\n}
                if (in_array($this->options['brace_style'], array('standard', 'ansi')))
                    { $this->e("\n"); }
                
                // Print the space in: -----------v
                //        #search p { (definition) }
                elseif ((in_array($this->options['brace_style'],
                        array('compact','ownline')) &&
                        (!$this->options['property_compact'])))
                    { $this->e(' '); }

				$this->e('}');
				$this->e(str_repeat("\n", $this->options['definition_newlines']));
			}
		}
	}
}


/* Class StCLI
 * ==================================================================== */

class StCLI
{
    /* Class: StCLI
     * Command line interface controller.
     * [Internal]
     */

    function parseArgs($argslist)
    {
        /* Function: parseArgs()
         * Parses command-line arguments into an associative array.
         * 
         * Usage:
         *     parseArgs(array $argslist)
         *
         *   The input expected is expected to be from `$_SERVER['argv']`,
         *   an array of strings, with each item being a single argument.
         * 
         * Example:
         *   It takes an input array (in `argv` format) in the likes of: 
         * 
         *     Array (
         *       [0] => "-verbose",
         *       [1] => "remote=127.0.0.1 24",
         *       [2] => "ftp.remote.org"
         *       [3] => "localhost"
         *     ) 
         *
         *   And outputs an array in the format: 
         * 
         *     Array (
         *       [verbose]   => TRUE,
         *       [remote]    => "127.0.0.1 24",
         *       [arguments] => array( "ftp.remote.org", "localhost" )
         *     )
         * 
         */

        $output = array();
        $output['args'] = array();
        foreach ($argslist as $args)
        {
            $flag  = '(?:--?(?<flag>[a-zA-Z0-9\-\_]+))';
            $kv    = '(?:(?<kv>(?:[a-zA-Z0-9\-\_]+)=(?:.*)))';
            $word  = '(?:(?<word>.*))';
            preg_match_all("~^$flag|$kv|$word\$~", $args, $m);
        
            foreach ($m['flag'] as $flag) if ($flag != '')
                { $output[$flag] = TRUE; }
            foreach ($m['kv'] as $str) if ($str != '')
                { $output[substr($str,0,strpos($str, '='))] = substr($str,strpos($str, '=')+1); }
            foreach ($m['word'] as $str) if ($str != '')
                { $output['args'][] = $str; }
        }
        return $output;
    }

    function go()
    {
        /* Function: go()
         * To be documented.
         *
         * Description:
         *   To be documented.
         */

        array_shift($_SERVER['argv']);
        $args = $this->parseArgs($_SERVER['argv']);
        if (isset($args['help']))
        {
            $css = new StyleTidy(''); 
            echo "I need somebody, help! Not just anyone but help!\n";
            echo "Usage: csstidy [preset=<preset>] [-debug] [OPTIONS]\n";
            echo "\n";
            echo "Common usage examples:\n";
            echo "  cat style.css | styletidy preset=clean > style2.css\n";
            echo "\n";
            echo "Preset options:\n";
            echo "(Refer to the documentation for more information on each of "
                ."these presets.)\n";
            foreach ($css->presets as $preset => $v)
            {
                echo "  preset=$preset\n";
            }
            echo "\n";
            echo "Options:\n";
            echo "(Refer to the documentation for more information on each of "
                ."these options.)\n";
            foreach ($css->options as $o => $value)
            {
                $count = 31 - strlen($o);
                if ($count < 0) { $count = 0; }
                $type = gettype($value);
                echo "  $o=<value>" . str_repeat(' ', $count) . " $type\n";
            }
            return;
        }

        $input = file_get_contents('php://stdin');
        $css = new StyleTidy($input);

        if (isset($args['preset']))
            { $css->loadPreset($args['preset']); unset($args['preset']); }

        $action = 'printout';
        if (isset($args['debug']))
            { $action = 'debug'; unset($args['debug']); }

        if (count($args > 0))
            { $css->loadOptions($args); } 

        // Do it!
        $css->{$action}();
    }

    /* Properties
     * ==================================================================== */
    
    /* Property: $css
     * String. The contents of the unparsed CSS.
     */
    var $css;

    /* Property: $data
     * Array. The CSS document broken down into parts.
     */
	var $data;

    /* Property: $caret
     * Integer. Kung nasaang column yung cursor sa output.
     */
    var $caret = 0;

    /* Property: $output
     * String. The output string; this is populated by [[e()]].
     */
    var $output;

    /* Property: $options
     * The options. This is first copied from [[StSettings::$defaults]],
     * then populated by [[StCLI]] based on what are given in the command line.
     */
    var $options = array();

    /* Property: $presets
     * Array. The presets. This is populated with data on
     * [[StSettings::$presets]].
     */
    var $presets = array();
}


/* End
 * ==================================================================== */

$c = new StCLI();
$c->go();
