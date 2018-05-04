<?php
    $page_title = "Course Page";
    $css_path = "../../Phase4/css/styleJ.css";
    $main_id = "course";
    include('../php/inc.header.php');
    include('../php/inc.dbcon.php');
?>
<script src="../../Phase4/js/sidebar.js"></script>
<body>
<div id="stres_info">
    <div id="sidebar">
         <script>sideBarLoad("Student Resorces","home.php","Resources Home","tutor.php?subj=null","Tutoring","software.php","Software","advisor.php","Advising","course.php","Course Information","../StudentResources/Jobs-JM.php","Job Market Info","../StudentResources/Jobs-IO.php","Internship Opportunities");</script>
    </div>
    <div id="center">
        <h2>List of Courses:</h2>
        <div class='tool'>
            <form>
                <p>Choose Category:</p>
                    <select onchange="location = this.value;">
                    <option value="course.php" <?php if(!isset($_GET['subj']) || ($_GET['subj'] == "")){ echo 'selected';} else { echo ''; }?> >All Courses</option>
                    <option value="course.php?subj=BIOL" <?php if(isset($_GET['subj']) && ($_GET['subj'] == "BIOL")){ echo 'selected';} else { echo ''; }?>>Biology Courses</option>
                    <option value="course.php?subj=CHEM" <?php if(isset($_GET['subj']) && ($_GET['subj'] == "CHEM")){ echo 'selected';} else { echo ''; }?>>Chemistry Courses</option>
                    <option value="course.php?subj=STAT" <?php if(isset($_GET['subj']) && ($_GET['subj'] == "STAT")){ echo 'selected';} else { echo ''; }?>>STAT Courses</option>
                </select>
            </form>
        </div>
        <br><br><br>
        <div class="vertical-menu">
            <?php
                if(isset($_GET['subj'])){
                    printCourseClasses($_GET['subj']);
                }
                else{ 
                    printAllClasses();
                }
            ?>
        </div>
    <br><br><br><br>

        <?php
            if(isset($_GET['class'])){
                echo '<h2>Course Information:</h2>';
                echo "<div id='course_info'>";
                printClassDescription($_GET['class']);
                echo '</div>';
            }
        ?>
    </div>
</div>
</body>
<?php
    $copyright_year = "2017";
    $copyright_text = "All praise the Guy.  The Guy is great and mighty!";
    include('../php/inc.footer.php');
?>