<span style="font-size: 2rem" class="event-noti">
    <i class="fal fa-bell"></i>
</span>

<div class="event-noti" id="event-noti">
    <!--SHOW NOTIFICATIONS COUNT.-->
    @include('CRM.elements.Notifications.count-noti', ['countComments' => $countComments])
</div>

<!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
<div id="noti_Button"></div>

<!--THE NOTIFICAIONS DROPDOWN BOX.-->
<div id="notifications">
    <h3>Notifications</h3>
    <div style="max-height:300px; padding: 0 9px; overflow: scroll" id="noti_append">
        @include('CRM.elements.Notifications.comment', ['commentTasks' => $commentTasks])
    </div>
    <div class="seeAll"><a href="#">See All</a></div>
</div>

<script>
    $('.event-noti').click(function () {

        // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
        $('#notifications').fadeToggle('fast', 'linear', function () {
            if ($('#notifications').is(':hidden')) {
                $('.event-noti').css('background-color', '#2E467C');
            }
            // CHANGE BACKGROUND COLOR OF THE BUTTON.
            else $('.event-noti').css('background-color', '#FFF');
        });

        // $('#noti_Counter').fadeOut('slow');     // HIDE THE COUNTER.

        return false;
    });

    // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
    $(document).click(function () {
        $('#notifications').hide();

        // CHECK IF NOTIFICATION COUNTER IS HIDDEN.
        if ($('#noti_Counter').is(':hidden')) {
            // CHANGE BACKGROUND COLOR OF THE BUTTON.
            $('.event-noti').css('background-color', '#2E467C');
        }
    });

    $('#notifications').click(function () {
        return false;       // DO NOTHING WHEN CONTAINER IS CLICKED.
    });
</script>
