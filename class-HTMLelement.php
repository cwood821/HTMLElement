<?php
/*
  HTML Element Class
  Author: Christian Wood
  Website: christianwood.net
*/

/**************************************************************
  Class Definition
***************************************************************/
class HTMLElement {

    public function __construct( $tag, $atts, $innerHTML )
    {
        $this->tag = $tag;
        $this->atts = $atts;
        $this->innerHTML = $innerHTML;
    }


    public function get_tag() {
      return $this->tag;
    }


    public function get_atts() {
      return $this->atts;
    }


    public function get_innerHTML() {
      return $this->innerHTML;
    }


    public function set_tag( $newTag ) {
      $this->tag = $newTag;
    }


    public function set_atts( $newAtts ) {
      $this->atts = $newAtts;
    }


    public function set_innerHTML( $newInnerHTML ) {
      $this->innerHTML = $newInnerHTML;
    }


    /*
      Advanced HTML attribute functionality
    */

    public function has_att( $att ) {
      return array_key_exists( $att, $this->atts );
    }


    // Set the value of a specific object attribute
    // if that attribute exists; if not, return null.
    public function set_att( $att, $value ) {
      // Confirm that the object has the attribute
      if ( $this->has_att( $att ) ) {
        $this->atts[$att] = $value;
      } else {
        return NULL;
      }
    }


    public function add_att( $att, $value ) {
      // If the object has the attribute already, return null
      if ( $this->has_att( $att ) ) {
        return NULL;
      } else {
        // Create the new attribute array item
        $this->atts[$att] = $value;
      }
    }


    public function remove_att( $att ) {
      // If the object has the attribute, remove it
      if ( $this->has_att( $att ) ) {
        unset($this->atts[$att]);
      } else {
        return NULL;
      }
    }


    // Returns HTML tag with attributes and innerHTML as string
    public function get_element(){
      //Open tag
      $element = "<" .  $this->tag . " ";
      //Add attributes
      $element .= $this->format_string( $this->atts, "=", "'", "'" ) . ">";
      //Add innerHTML and close tag if not a void element
      if ( !$this->is_void() ) {
        $element .= $this->innerHTML;
        $element .= "</" .  $this->tag . ">";
      }

      return $element;
    }


    /*
      Returns single line string from an array of 'key' => 'value' pairs.
      $divider parameter is the string that will divide elements,
      $valWrap* parameters represent strings that will wrap around array values.
      The function automatically formats a 'style' attribute to the CSS standard.
    */
    private function format_string($theArray, $divider, $valWrapStart, $valWrapEnd) {
      $str = "";
      $theKeys = array_keys( $theArray );
      $theValues = array_values( $theArray );

      for ( $i = 0; $i < count( $theArray ); $i++ ) {
        // 'style' value is formatted as inline CSS
        if( $theKeys[$i] === 'style' ) {
          $str .= $theKeys[$i] . $divider . $valWrapStart;
          $str .= $this->format_string( $theValues[$i], ":", "", ";"  ) . $valWrapEnd;
        } else {
          $str .= $theKeys[$i] . $divider . $valWrapStart . $theValues[$i] . $valWrapEnd;
        }
      }

      return $str;
    }


    // Returns true/false if the tag is a void HTML element
    // List of void elements from W3C:
    // https://www.w3.org/TR/html/syntax.html#void-elements
    private function is_void() {
      $voidElements = array(
        "area", "base", "br", "col", "embed",
        "hr", "img", "input", "keygen", "link",
        "meta", "param", "source", "track", "wbr"
      );

      return in_array($this->tag, $voidElements);
    }
}


?>
