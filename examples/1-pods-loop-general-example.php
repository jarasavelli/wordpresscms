<?php
    //set up pods::find parameters to limit to 5 items
    $param = array(
        'limit' => 5,
    );
    //create pods object
    $pods = pods('pod_name', $params );

    //check that total values (given limit) returned is greater than zero
    if ( $pods->total() > 0 ) {
        //loop through items pods:fetch acts like the_post()
       while ($pods->fetch() ) {

           //get the raw value of a field
           //in this case it's an array of data for an image
           $picture = $pods->field('picture');
           //pass ID of image to a WordPress image function and output it
           echo wp_get_attachment_image( $picture['ID'] );

           //get the value of a field, ready to be outputted
           $text = $pods->display('field_name');
           _e( $text, 'text-domain' );

           //check if a specific field ($field) is set to a specific specific value ($value)
           $field = 'field_name';
           $value = 'desired_value';
           if ( $pods->is( $field, $value ) ) {
               //display field if true
               _e( $pods->display( $field )), 'text-domain' );
           }

           //check if a specific field ($field) has a specific value ($value) anywhere in it.
           $field = 'field_name';
           $value = 'desired_value';
           if ( $pods->has( $field, $value ) ) {
               //display field if true
               _e( $pods->display( $field )), 'text-domain' );
           }

           //get an entire row of data for current item
           $row = $pods->row();
           //check that it isn't empty before continuing
           if ( !empty( $row ) ) {
                //do something with
           }
           //Fetch the nth state (in this case third) value of the row
           $value = $pods->nth(3);
           
           //fetch odd numbered states
           //equivalent to nth( 'odd' );
           $odd = $pods->zebra();


       } //endwhile
    } //endif
?>