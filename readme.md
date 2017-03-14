# HTMLElement
The HTMLElement class provides a simple way to dynamically generate and use HTML element objects in PHP scripts. For small projects and WordPress plugins, it substitutes for hard-coding messy HTML strings in PHP.

## Usage

1. Include/Require the file in your PHP file.
2. Instantiate a new HTMLElement object with three parameters:
- $tag: A string, the HTML tag to created.
- $attributes: A key=>value array, the attributes that the HTML tag will have.
- $innerHTML: A string, the inner value of the HTML tag.

```php
// An anchor tag example.
// This example assumes a WordPress post object is available.
$atts = array(
  'href' => get_permalink( $post->ID )
);

// Instantiate a new anchor tag.
$postLink = new HTMLElement( 'a', $atts, $post->post_title );

// To return the full element as a string,
// use the HTMLElement->get_element() method.
echo $postLink->get_element();

// Getters are also available for individual
// element properties.
$postLink->get_tag();
$postLink->get_atts();
$postLink->get_innerHTML();
```

## Notes
- The class handles [void html elements](https://www.w3.org/TR/html/syntax.html#void-elements). These will not be closed.
- Inline CSS style should be passed as a sub-array in the attributes array. The class will automatically format style attributes appropriately.
```php
// Create paragraph tag with bold styling.
$atts = array(
  'style' => array(
	  'font-weight' => 'bold'
  )
);
$postLink = new HTMLElement( 'p', $atts, $post->post_title );
```
