
# Bell-Scheduling

Bellarmine (Bell) Scheduling Software by Chanan Walia and John Yang

This application can be utilized to set a school's schedule for the day online and then have the schedule be displayed on monitors around campus. There is a web and a local component. The app was created for a final project for a Data Structures Honors class at Bellarmine College Preparatory in San Jose, CA.

The web component provides an interface to view, create, and edit a day’s schedule. It uses HTML, Javascript, and CSS for all front end code (mostly using the Bootstrap framework for its grid/toolbar system) and PHP for all of the backend. The user is presented with three pages: Current Schedule, Set Schedule, and API Docs. The Current Schedule displays the currently saved agenda and announcements (components of each schedule) in table representations. The Set Schedule page lets the user either use presets to configure the agenda or create the agenda him/herself. It lets the user create up to three announcements to accompany the agenda. The API docs provides the URL to access the schedule and explanation of the output of the API call. It presents a sample output and explains each part of it. All schedule information is stored in two text files: schedule.txt and schedule_count.txt. The former stores the plain schedule information and the latter provides the number of agenda items and announcements that former file has. (This makes it possible to use Scanner in Java efficiently, and it helps in the display and auto-form-filling in the web interface)

The Java component calls the API of the web component and receives all of the schedule information. It stores the schedule information in custom class objects and it proceeds to generate a PNG image with the aspect ratio of a US-Letter-size paper. It works to create a readable image, spacing items evenly given the variable number of agenda items/announcements. It uses color labels to correspond with “type” values created in the web interface.

![Schedule Display and Homepage](/Screenshots/01_schedule_display_home.png?raw=true "Schedule Display and Homepage")
![Schedule Editing Page](/Screenshots/02_schedule_edit.png?raw=true "Schedule Editing Page")
![API Access Information and Example Page](/Screenshots/03_api_information.png?raw=true "API Access Information and Example Page")
