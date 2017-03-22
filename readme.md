# HTMLElement
The HTMLElement class provides a simple way to dynamically create and use HTML element objects in PHP scripts. For small projects or WordPress plugins, it substitutes for hard-coding messy HTML strings in PHP.

## Usage

1. [Include](http://php.net/manual/en/function.include.php) or [Require](http://php.net/manual/en/function.require.php) the file in your PHP script.
2. Instantiate a new HTMLElement object with three parameters:
- $tag: A string, the HTML tag to created.
- $attributes: A key=>value array, the attributes that the HTML tag will have.
- $innerHTML: A string, the inner value of the HTML tag.

```php
object HTMLElement ( string $tag , array $attributes, string $innerHTML )
```

## Examples & Functionality

Create a link to a WordPress post. This example assumes that the HTMLElement class has been included in this script and that a WordPress post object is available as $post.

```php
// Set up the attributes for the anchor tag
$atts = array(
  'href' => get_permalink( $post->ID )
);

// Instantiate a new HTML element, an anchor tag.
$postLink = new HTMLElement( 'a', $atts, $post->post_title );

// To return the full element as a string,
// use the HTMLElement->get_element() method.
echo $postLink->get_element();

```

Getters and Setters are available for individual object properties.

```php
// Getters
$postLink->get_tag();
$postLink->get_atts();
$postLink->get_innerHTML();

// Setters
$postLink->set_tag( $newTag );
$postLink->set_atts( $newAtts );
$postLink->set_innerHTML( $newInnerHTML );

```

Helper functions specific to the addition, removal, and manipulation of attributes are also available.

```php
// Check for existence of an attribute
// Takes string of attribute, returns a boolean value
$postLink->has_att( $theAtt );

// Set the value of an existing attribute
// Takes the string of existing attribute and a new value for it.
$postLink->set_att( $theAtt, $newValue );

// Add a new attribute to the object
// Takes a string for a new attribute and a value attribute.
$postLink->add_att( $theAtt, $someValue );

// Remove an attribute from the object
// Takes a string for a the attribute to remove
$postLink->remove_att( $theAtt );
```

Inline CSS style should be passed as a sub-array in the attributes array. The class will automatically format style attributes appropriately.
```php
// Create paragraph tag with bold styling.
$atts = array(
  'style' => array(
	  'font-weight' => 'bold'
  )
);

$postTitle = new HTMLElement( 'p', $atts, $post->post_title );

```

## Notes
- The class handles [void html elements](https://www.w3.org/TR/html/syntax.html#void-elements). These tags will not be closed and will not have innerHTML.
