##Initial Planning
Definition of our Scrum Master:
* Scheduling update meetings.
* Maintain github issue database (sprint backlog).
* Resolve team conflicts and scheduling issues.
* Designate roles and assign tasks to front-end, back-end teams.

We will rotate scrum master every phase for those who would like to do it, for this phase our scrum master will be Rathusshan.
Our scrum master will not designate help, because he may not have the most technical knowledge in a certain area. Instead our front-end, back-end leaders (see sprint backlog below for explanation) can inform the scrum master on how front-end/back-end tasks need to be changed and what issues they are having.

Estimating Task Size:

We will label each github issue (task in sprint backlog) as Small(S), Medium(M) or Large(L).
* S - Task that requires 1-2 hours of coding/testing.
* M - Task that requires 3-6 hours of coding.
* L - Task that will span a day or multiple days, with sitdown meetings needed for design decisions.


##Sprint Backlog
What we are building:
a web app using HTML/CSS/Javascript (front-end), PHP, mySQL for backend.
With our chosen user stories below, we have focused on increasing classroom interaction by allowing for anonymity and ease of use in asking questions.

Chosen user stories, centered around basic question/answer, anonymity and the struggling shy student.

1. As an average computer science student who struggles with public speaking, I want to be able to ask questions so that I can get the most out of my university education.
2. As an instructor I want to encourage all members of the class to have an equal opportunity to ask questions so that each student feels like they understand the material.


Potential Features for end goal:
* Mobile compatible
* Signup/Login system with room code.
* Each classroom with the app will have its own question/answer session for each lecture.
* A split-view for professors to see incoming questions and an area to ask the room a question.
* Rating system for all student questions, that students can upvote/downvote.
* A split-view for students to see student questions and to ask/answer prof question.
* Anonymity - Students see other students as anonymous, professor can still see student names/email's.
* Professor can record response to the question while its being said, and stored in lecture session database (mp3 file).
* Office hours support
* Confusion indicator during lecture

**How we plan to build it**

Our team of six is split into two, having a team of 3 to work on the front-end and vice-versa for the back end. 
We chose this approach so we have leaders for both teams (front-end: Allahverdi and back-end: Denis) that are technically experienced in those areas, and have a better idea of how to estimate task sizes and designate help.
* We have ordered the tasks to be completed vertically as typed out in the list below.

**Phase 2 Sprint Backlog**
* Each task below links to a github issue.
* Issues are labelled with Small, Medium or Large and what team its designated too (front-end or back-end)
* Each task is assigned to a member of one of the respective teams, but may also have collaborations to complete the task.
* Tasks that have a milestone of phase2, are tasks for the phase 2 sprint backlog.
* For phase2 our sprint backlog is focused on getting all our templates setup, login/registration, joining classes/lectures and basic question/answer w/ live updating questions.

Back-end: (Denis, Sarkhan, Rath)
* [Templates (rough front-end) for our back-end. (L)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/14)
* [Setup local database. (S)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/15)
* [Simple sign up/login system (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/16)
* [Prof will be able to “create lecture sessions” (S)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/17)
* Setup student side - revised from update meeting 3 to sub divide into 3 tasks
 * [Enrolling in class by room code. (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/18)
 * [Students can view lecture pages and my classes. (S)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/19)
 * [Setup a question text box for student. (S)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/20)
* Question/Answer - revised from update meeting 3 to subdivide into 2 tasks
 * [Live updating questions (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/21)
 * [Student asking a question to the prof and connect that with the live updating questions. (S)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/22)
* [~~Displaying logs of questions per lecture~~](https://github.com/csc301-fall-2015/project-team8-L5101/issues/24)
 * Removed after update meeting 2
 
Front-end: (Al, Tommy, Kevin)
* [Overall design decision (S)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/9)
 * Each of these three will make designs for front-end and then put them all together.
 * Revised after update meeting 1, to be a rough sketch. Final idea to be completed on sunday.
* [Login screen (S)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/10)
* [Lecture session selection view (S)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/11)
* [Answering/Asking questions view (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/12)
* [Differentiate the views between student and prof (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/13)

Both:
* [Front-end/Back-end leaders final merge between front-end and back-end. (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/23)

Potential tasks for next phase (as discussed after update meeting 2)
* [Rating system for questions](https://github.com/csc301-fall-2015/project-team8-L5101/issues/25)
* Office hours
* [Confusion indicator](https://github.com/csc301-fall-2015/project-team8-L5101/issues/26)

##Update Meetings

**Update Meeting #1**
* Time: Tuesday Oct 27 at 10pm
* Location: Online meeting on Slack
* Participants: Front-End team - Al, Kevin, Tommy

Subject: Design decisions for front end
- Went over some general sketches of what each view would look like.
- Need some more time to sketch out details like placement of buttons and text boxes.
- Kevin suggests the front-end team should meet on sunday to iron out details and code together.
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

![Alt text](https://github.com/csc301-fall-2015/project-team8-L5101/blob/master/doc/phase2/Burndown%20Chart.PNG "Team Burndown")

![Alt text](https://github.com/csc301-fall-2015/project-team8-L5101/blob/master/doc/phase2/Individual%20Burndown%20Chart.PNG "Individual Burndown")


##Review & Retrospective

1.a) In our first group meeting, we discussed all the possible ideas to incorporate into our Phase 2. To facilitate the speed of our progress, we decided to relax our limitations in terms of our plan. In other words, we want to decide what is the maximum amount of work we would be able to accomplish before the deadline. After we have come up with a plan, we would then trim it down through a series of analysis and extrapolations. Initially, our plan was quite large. It included finishing many functions within the front-end and the back-end. This includes setting up the database and the back-end connection, login and sign up system, keeping and retrieving logs of questions in the database, and many more. Obviously, this was too much. Consequently, we decided to cut down some tasks including sessions for specific users, ability for professors to kick out users from current lecture sections, and many more detailed functions that we deemed not suitable for this phase. The main reason these functions did not the make the cut is because we decided they are too detailed. We would like to focus entirely on the back-bone of the web app before moving on to little details. Thus, a good fundamental start would result in a more successful product.

b) Tasks that were split before being completed include the entire front-end and back-end. In the beginning, we split up the work by specific functions of the web app. However, it proved to be inadequate as complications and disorganization arose. It was hard to remember who is working on what. Thus, we decided to group people up by front-end and back-end. From there, the group would appoint a sub Scrum leader that deals with the overall function of the group. Additionally, the two sub Scrum leaders would frequently communicate in order to effectively merge the front and back-end.

2.a) Splitting up the main task into subtasks was primarily our most successful decision. Having each person assigned to a sub team of back-end and front-end gave each team more purpose and more motivation to complete their assigned task. Since each team was operating semi-independently, the group apathy problem presented in many group assignments was diminished. That being said, there was still multiple decisions that didn’t pan out.

b) When there is a group of six students working together, there are bound to be problems. Because there are all types of students with different experience in web development programming, there were issues in partitioning the workload effectively. When deciding who works on the back-end, we decided to assign two inexperienced members with somebody who already knew about back-end web development. If this was an ideal world, the two inexperienced members would have had a mentor to guide them through the process of development been able to learn first-hand. Instead, one person ended up with a lot of the work.  

c) For the next sprint, our group is determined to meet more often, whether it be in person or online. It is very easy to forget about your responsibility to the group with only one meeting a week, and hence a lot of work got done on the later stages of this sprint. Another improvement that can be made is our work ethic, and specifically our dedication to follow the scrum environment. Not many of us have had to do backlogs, burndown charts, or what have you, so there was understandably some growing pains. 
 

