<?php

define ('DB_HOST', 'localhost');
define ('DB_NAME', 'teambugsphase4');
define ('DB_USER', 'root');
define ('DB_PWD', 'password');
define ('MYSQL_CONNECTION_STRING', 'mysql:host='.DB_HOST.';dbname='.DB_NAME);


global $content;


function get_text_dump($page){

    global $content;
    
    try{
        $pdo= new PDO(MYSQL_CONNECTION_STRING, DB_USER, DB_PWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        #echo "connected to data base<br/>";

        $sql = "SELECT contenttype, content FROM textdump WHERE pagename='". $page."'";

        $result_set = $pdo->query($sql);
        $sql = NULL;
        $content = $result_set->fetchAll(PDO::FETCH_ASSOC);

       # echo "content extracted";
    }
    catch(PDOExceptoin $e){
        echo"did not connect";
        die();
    }
}

function get_career_opertunities($page){
    global $content;
    
    try{
        $pdo= new PDO(MYSQL_CONNECTION_STRING, DB_USER, DB_PWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        #echo "connected to data base<br/>";

        $sql = "SELECT content FROM careeropertunities WHERE pagename='". $page."'";

        $result_set = $pdo->query($sql);
        $sql = NULL;
        $content = $result_set->fetchAll(PDO::FETCH_ASSOC);

       # echo "content extracted";
    }
    catch(PDOExceptoin $e){
        echo"did not connect";
        die();
    }
}

function get_research(){
    
        global $content;
        
        try{
            $pdo= new PDO(MYSQL_CONNECTION_STRING, DB_USER, DB_PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            #echo "connected to data base<br/>";
    
            $sql = "SELECT content, url FROM research";
    
            $result_set = $pdo->query($sql);
            $sql = NULL;
            $content = $result_set->fetchAll(PDO::FETCH_ASSOC);
    
            #echo "content extracted";
        }
        catch(PDOExceptoin $e){
            echo"did not connect";
            die();
        }
}

function get_admission(){
        
    global $content;
            
    try{
        $pdo= new PDO(MYSQL_CONNECTION_STRING, DB_USER, DB_PWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
    #echo "connected to data base<br/>"; //debug
        
        $sql = "SELECT content, contenttype FROM admissions";
       
                $result_set = $pdo->query($sql);
                $sql = NULL;
                $content = $result_set->fetchAll(PDO::FETCH_ASSOC);
        
    #echo "content extracted"; //debug
            }
            catch(PDOExceptoin $e){
                echo"did not connect";
                die();
            }
}

function get_sample($page){
        
    global $content;
    
    try{
    $pdo= new PDO(MYSQL_CONNECTION_STRING, DB_USER, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    #echo "connected to data base<br/>"; //debug

        for($x = 1; $x < 9; $x++){
            $sql = "SELECT course, credits FROM curriculum Where semester='".$x."' and majorname = '".$page."'";
            
            $result_set = $pdo->query($sql);
            $sql = NULL;
            $semester1 = $result_set->fetchAll(PDO::FETCH_ASSOC);

            $sql = "SELECT course, credits FROM curriculum Where semester='".$x."' and majorname = '".$page."'";
            
            $result_set = $pdo->query($sql);
            $sql = NULL;
            $content[$x] = $result_set->fetchAll(PDO::FETCH_ASSOC);
        };
    

    #echo "content extracted"; //debug
        }
        catch(PDOExceptoin $e){
            echo"did not connect";
            die();
        }
}

function display_content($value){
    if($value == NULL){
        echo "sql returned blank";
    }

    foreach($value as $option){
            echo '<p>'. $option['content'] .'</p>';
    }
}

function display_undergrad_content($value){
    if($value == NULL){
        echo "sql returned blank";
    }

    foreach($value as $option){
        if($option['contenttype']== 'h'){
            echo '<h2>'.$option['content'].'</h2>';
        }else{ 
            echo '<p>'. $option['content'] .'</p>';
        }
       
    }
}

function display_research_content($value){
    if($value == NULL){
        echo "sql returned blank";
    }

    #imagine standing at the grand canyon 
    echo " <h2>List of Research Topics:</h2><br/>";
    echo "<div class='vertical-menu'>";

    foreach($value as $option){
        
        echo '<p>'.$option['content'].'</p><br/>';

    }
        echo "</div>";
}
  
function display_admission_content($value){
    if($value == NULL){
        echo "sql returned blank";
    }

    foreach($value as $option){
        
        if($option['contenttype'] == 'h'){
            echo '<h2>'.$option['content'].'</h2>';
        }
        elseif($option['contenttype'] == 'o'){
            echo '<p><sapn face=Wingdings" class="wing" onclick="accordion()">o</span>'.$option['content'].'</p>';
        }
        elseif($option['contenttype'] == 'g'){
            echo '<div class="panel"><p>'.$option['content'].'</p></div>';
        }
        else{
            echo '<p>'.$option['content'].'</p>';
        }
    }

}

function echo_content($value){
    if($value == NULL){
        echo "sql returned blank";
    }
    else echo($value);
}

function display_curriculum($value){
    if($value == NULL){
        echo "sql returned blank";
    }
    if($value == 'integrative'){
        $value = 'interative';
    }
    else {
        echo '<table border="0" class="curriculum" >';
        echo '<tbody>
                <tr>
                    <th>Term</th>
                    <th class="spacer">&#160;</th>
                    <th>Course</th>
                    <th class="spacer">&#160;</th>
                    <th width="40">Credit<br />Hours</th>
        </tr>';
        $c = 1;
        for($x=1; $x < 9; $x++){
        
            if($x%2 == 1){
                
                $semester = 'Fall<br/>Year '.$c;
            }
            else{
                $semester = 'Spring<br/>Year '.$c;
                $c++;
            }

            echo'<tr><td class="term-top" rowspan="6" width="65">'.$semester.'</td>';

            foreach($value[$x] as $option){
              echo'<td class="spacer">&#160;</td>
                        <td class="top">'.$option['course'].'</td>
                        <td class="spacer">&#160;</td>
                        <td class="hours-top" width="40">'.$option['credits'].'</td></tr>';
                }
                echo '</tr>';
            
        }
        
        }


}

function get_grad_req($page){
    global $content;
    
    try{
        $pdo= new PDO(MYSQL_CONNECTION_STRING, DB_USER, DB_PWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        #echo "connected to data base<br/>";

        $sql = "SELECT contenttype, content FROM gradrequirements WHERE degree='".$page."'";

        $result_set = $pdo->query($sql);
        $sql = NULL;
        $content = $result_set->fetchAll(PDO::FETCH_ASSOC);

        #echo "content extracted";
    }
    catch(PDOExceptoin $e){
        echo"did not connect";
        die();
    }
}

function display_grad_req($value){
    if($value == NULL){
        echo "sql returned blank";
    }

    foreach($value as $option){
        if($option['contenttype']== 'h2'){
            echo '<h2>'.$option['content'].'</h2>';
        }
        elseif($option['contenttype']== 'h3'){
            echo '<h3>'.$option['content'].'</h3>';
        }
        else{ 
            echo '<p>'. $option['content'] .'</p>';
        }
       
    }
}
?>