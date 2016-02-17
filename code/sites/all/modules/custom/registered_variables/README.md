Registered Variables module manual

This module can be used for assigning variables to beans, nodes and views. 
To assign variables use a pair of functions hook_registered_variables_alter() 
and your_callback().

Function hook_registered_variables_alter() has an argument $variables passed 
by reference. This argument is an instance of RegisteredVariables class with 
the following public methods:

  - get()     - Returns an array of registered variables sets along with 
                conditions. This is a static method.

  - process() - Processes variable sets and assigns variables to beans, nodes 
                and views. This is a static method.

  - set()     - Adds a callback function which returns variables for the given 
                bean, node or view. This method is used as follows:
                $variables->set(
                  'callback' => 'your_callback'
                  'conditions' => array(
                    'property_name' => property_value
                  )
                );

                Property name must be one of the following:
                bid - beans only,
                component_type - can be 'node', 'view' or an entity type,
                delta - beans only,
                name - views only,
                nid - nodes only,
                type - nodes and beans

                Property value can be a string or an array. In the latter case,
                variables will be assigned if the property value matches any 
                value within the array.

Callback function your_callback has an argument $context, which:
  a) In case of nodes and beans contains $build passed to 
     hook_entity_view_alter
  b) In case of of views contains $view passed to hook_views_pre_render

Function your_callback has to return an array with key value pairs for the 
variables e.g.:
array(
  'foo1' => 'bar1',
  'foo2' => 'bar2',
);

To print variables in your template use one of the following patterns, 
depending on the template:
$bean->variables['foo'];
$node->variables['foo'];
$view->variables['foo'];