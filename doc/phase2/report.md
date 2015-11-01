##Initial Planning
Definition of our Scrum Master:
* Scheduling update meetings.
* Maintain github issue database (sprint backlog).
* Resolve team conflicts and scheduling issues.
* Designate roles and assign tasks to front-end, back-end teams.

We will rotate scrum master every phase for those who would like to do it, so far we have Rathusshan and Allahverdi.
Our scrum master will not designate help, because he may not have the most technical knowledge in a certain area.
This is why our team of six is split into two, having a team of 3 to work on the front-end and vice-versa for the back end. 
We chose this approach so we have leaders for both teams (front-end: Allahverdi and back-end: Denis)
that are technically experienced in those areas, and have a better idea of how to estimate task sizes and designate help.
Therefore these front-end, back-end leaders can inform the scrum master on how front-end/back-end tasks to be changed and what issues
they are having.

Estimating Task Size:

We will label each github issue (task in sprint backlog) as Small(S), Medium(M) or Large(L).
* S - Task that requires 1-2 hours of coding/testing.
* M - Task that requires 3-6 hours of coding.
* L - Task that will span a day or multiple days, with sitdown meetings needed for design decisions.


##Sprint Backlog
What we are building:
a web app using HTML/CSS/Javascript (front-end), PHP, SQL for backend.
With our chosen user stories below, we have focused on increasing classroom interaction by allowing for anonymity and ease of use
in asking questions.

Features:
* Mobile compatible
* Signup/Login system with room code.
* Each classroom with the app will have its own question/answer session for each lecture.
* A split-view for professors to see incoming questions and an area to ask the room a question.
* Rating system for all student questions, that students can upvote/downvote.
* A split-view for students to see student questions and to ask/answer prof question.
* Anonymity - Students see other students as anonymous, professor can still see student names/email's.
* Log of questions is kept after each lecture session.
* Professor can record response to the question while its being said, and stored in lecture session database (mp3 file).

Chosen user stories, centered around basic question/answer and anonymity.

1. As an average computer science student who struggles with public speaking, I want to be able to ask questions so that I can get the most out of my university education.
2. As an instructor I want to encourage all members of the class to have an equal opportunity to ask questions so that each student feels like they understand the material.

**Phase 2 Sprint Backlog**

Front-end: (Al, Tommy, Kevin)
* Overall design decision (S)
 * Each of these three will make designs for front-end and then put them all together.
* Login page (S) 
* Lecture session selection view (S)
* Answering/Asking questions view (M)
* Differentiate the views between student and prof (M)

Back-end: (Denis, Sarkhan, Rath)
* Simple sign up/login system (S) - Denis
* Student prof asking/answering question
* Keeping logs of questions per lecture
* Prof will be able to “create lecture sessions”
* Students will be able to “log into lecture sessions”
* Ability to join the class
* Question/Answer text areas

Both:
* Front-end/Back-end leaders final merge between front-end and back-end. - Denis and Al

##Update Meetings

**Update Meeting #1**
* Time: Tuesday Oct 27 at 10pm
* Location: Online meeting on Slack
* Participants: Front-End team - Al, Kevin, Tommy

Subject: Design decisions for front end
- Went over some general sketches of what each view would look like.
- Need some more time to sketch out details like placement of buttons and text boxes.
- Kevin suggests the front-end team should meet on monday to iron out details and code together.
- Change sprint backlog design task, to just be a rough sketch, the finalized design will be done on sunday while coding with the team.

**Update Meeting #2**
* Time: Thursday Oct 29 at 8pm
* Location: Online meeting on Slack.
* Participants: Entire group.

Subject: Narrow down user group after meeting with TA.
- We need to distinguish between a regular q/a system and our live in lecture experience.
- Remove task from sprint backlog for students to view past logs of questions. This is not good for a product focused on the live lecture experience.
- Focus more on the in lecture live questions aspect to increase interactivity.
- Potential tasks to add to sprint backlog for later phases: Add in office hours? After the live lecture session is over so the student can know when to ask the prof their question.
- Narrow down on the user group: confused but shy student in lecture.
- Another potential task to add to backlog: Confusion indicator for students to press so prof has an idea if he/she needs to spend more time explaining the concept.

Final thoughts:
- Al: reemphasized that for this phase we are coding prof/student register/login andtwo text blocks for questions and answers. The ideas we have generated for narrowing our user group are perfect for the next phase.
- Denis: Schedule a backend meeting for friday, to split up tasks.

**Update Meeting #3**
* Time: Friday Oct 30 at 5pm
* Location: In-person at Bahen.
* Participants: Back-end team (Denis, Sarkhan, Rath) & Kevin

Subject: Split up tasks and subdivide back-end sprint backlog.
- Denis has set up the boiler plate for backend including login/registration, new lecture sessions.
- now must do the question answer part and live updating questions.
- rath will handle setting up student views, joining by room code
- sarkhan will handle question answer, using ajax and PHP
- Changes to sprint backlog: 
   * Sub divide setting up student views to task room code, task students can view lectures, task setup text boxes.
   * Split question/answer task to the first task of live updating questions. Then handle the task for student asking a question to the prof.
   
Final thoughts:
- Rath will work on setting up student stuff on saturday
- Sarkhan will work on question/answer after that.
- Denis will be available to answer any dev questions.


##Burndown Chart

##Review & Retrospective
