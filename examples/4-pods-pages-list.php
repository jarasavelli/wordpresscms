<?php
    /**
     * Template Name: Pods List
     *
     * List all items of a Pod using Pods Pages
     */

    get_header(); ?>

<div id="main-content" class="main-content">

    <?php
        <div id="primary" class="content-area">
		    <div id="content" class="site-content" role="main">
		    <?php
			 	//Setup Pod object
			 	//Presuming permalink structure of example.com/pod-name/item-name
                 //See http://pods.io/code/pods/find
			 	
			 	//Set $params to get 5 items
			 	$params = array(
                    'limit' => 5,
                );
                //get current pod name
                $pod_name = pods_v( 0, 'url');
                //get pods object
                $pods = pods( $pod_name, $params );
                
                //check that total values (given limit) returned is greater than zero
                if ( $pods->total() > 0 ) {
                    //loop through items using pods::fetch
                    while ($pods->fetch() ) {
                        //Put title/ permalink into variables
                        $title = $pods->display('name');
                        $permalink = site_url( trailingslashit( $pod_name ) . $pods->field('permalink') );
                ?>
                        <article>
                        <header class="entry-header">
                        <h1 class="entry-title">
                        <a href="<?php echo esc_url( $permalink); ?>" rel="bookmark"><?php _e( $title , 'text-domain' ); ?></a>
                        </h1>
                        </header><!-- .entry-header -->
                        <div class="entry-content">
                        <!--@todo output some fields here.-->
                        <a href="<?php echo esc_url( $permalink); ?>" rel="bookmark" class="button primary"><?php _e( 'Read More', 'text-domain' ); ?></a>
                        </div><!-- .entry-content -->
                        </article><!-- #post -->
             	<?php
                    } //endwhile;
                } //endif;
                
               		// Output Pagination
               		//see http://pods.io/docs/code/pods/pagination
                	echo $pods->pagination( );
            	?>
        </div><!-- #content -->
    </div><!-- #primary -->
 </div><!-- #main-content -->

<?php
    get_sidebar();
    get_footer();