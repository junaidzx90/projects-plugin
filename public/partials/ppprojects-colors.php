<style>
    :root{
        --pp_projects_project_bg: <?php 
            if(get_option('pp_projects_project_bg')){
                echo get_option( 'pp_projects_project_bg' );
            }else{
                echo '#ffffff';
            }
        ?>;
        --pp_projects_project_bg: <?php 
            if(get_option('pp_projects_project_bg')){
                echo get_option( 'pp_projects_project_bg' );
            }else{
                echo '#3a3a3a';
            }
        ?>;
        --pp_projects_text_color: <?php 
            if(get_option('pp_projects_text_color')){
                echo get_option( 'pp_projects_text_color' );
            }else{
                echo '#3a3a3a';
            }
        ?>;
    }
</style>