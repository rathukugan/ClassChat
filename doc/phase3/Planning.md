# Initial Planning (Sprint Backlog)

From earlier descriptions our product is a web app using HTML/CSS/Javascript (front-end), PHP, mySQL for backend. Through iterations of our MVP, we have focused on the in lecture experience to increase classroom activity and help students excel.

From planning.md, our group followed a similar scrum process to phase 2, thus this is our sprint backlog for phase 3. Since our front-end was mostly completed during phase 2, this phase involves all back-end tasks to complete the features listed below. Phase 2 implemeneted the core of our app, setting up professor and student POV's. For phase 3 we have implemented the core functionality of asking questions, providing for real time updates. Also continuing from phase2, we have denoted tasks as Small (S), Medium (M) or Large (L).

**Note: Cancellations are noted by strikethrough and readjustments bolded and are further explained in nested list. We combined adjustments with initial backlog below, to easily see the transition of our backlog. Most tasks are linked to it's respective github issue (our sprint backlog database).**

### Sprint Backlog
* [Allow students to ask a question in lecture (S)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/22)
* Live Lectures (L)
 * [Questions showing up live (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/42)
 * [Lectures have an expire time (start and end session) (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/44)
 * [Question Rating system for each live lecture (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/25)
* Profile/Class Customization (CRUD)
 * [Prof's editing class description, delete a class (S)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/39)
 * [Allow users to change password (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/40)
 * [Students can drop classes. (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/41)
* [Students can view question history (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/36)
 * **Readjustment:** Keep a set of all questions the student asked, but note the ones that were unanswered.
 * Unanswered questions can be linked to office hours, email (as dicussed in update meeting)
* [~~Office hours support for question history (M)~~](https://github.com/csc301-fall-2015/project-team8-L5101/issues/37)
 * After wasting time on several technical issues for other extra features, we didnt get office hours support done.
 * We would have liked to create a form for prof's to fill out when their office hours are, then students in that class can view these set times, and see which prof has an ongoing office session when they log onto the app.
 * **Readjustment:** Offer [email support (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/54), so the student can directly email unanswered questions to the prof.
 * This can be worked to link to office hours in the future, so the student as the option of visiting the prof with these unanswered questions.
* [Students see each other as anonymous (S)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/38)
 * ~~Have unique random generated usernames.~~ (see change below)
 * **Readjustment:** Unique random usernames changed to random colours to make it much easier on performance (generating hundreds of small colour blocks as opposed to random strings) and visually.
* [Lecture feedback survey (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/45)
* [~~Prof submits a prepared quiz to the lecture room (M)~~](https://github.com/csc301-fall-2015/project-team8-L5101/issues/27)
 * This was a much more technically challenging feature than we imagined, because we had to setup listening for a certain number of students and sending a form to only those students.
 * Thus this was cancelled, but can be possibly implemented for the group presentation to demonstrate with the class, if time permits.
* [Notifications for prof of questions being asked (M)](https://github.com/csc301-fall-2015/project-team8-L5101/issues/43)
* [~~Confusion Indicator during lecture~~](https://github.com/csc301-fall-2015/project-team8-L5101/issues/26)
 * Removed after update meeting 1, details beind a confusion indicator can be too annoying to deal with + ambigious for the prof to determine what was confusing.
* ~~Prof recording voice answers~~
 * Technically challenging to do for this project time wise.
 * Takes away from the point of our app, we want the prof to easily transition to answer a question the student asks through the app.
* Mobile compatibility
 * **Readjustment:** Noticed that it was already done by phase 2 since bootstrap makes it work well with mobile already.
 * Had to make minor adjustments in grid layout, to look better on a mobile device.
* Front-end split-views that a student or prof has.
 * **Readjustment:** Prof's dont need a split view because they should pre write the quiz before sending it. Dont want prof to take lecture time to dynamically type out a question to ask.
 * **Readjustment:** Student's have a split view to ask questions and to see a display of all questions being asked live.
* ~~Hosting and database.~~
 * Dont need for phase 3 demo and it would have taken longer than we anticipated.
 * Can be done for phase 4 group presentation, so the class can ask questions while its going on?

# Review and Retrospective

**How our process worked**

During our first initial planning meeting where we generated our sprint backlog list, we divided up tasks based on experience that individuals in the group had. If group memebers were given a few tasks to do, our scrum master made sure that they relate together. This is so everyone had distinct tasks that minimize the amount of "code collision" and database collisions. This was also easy to do because for this phase we concentrated on features to enhance our core application. In terms of our process of completing backlog items, after development one would close the github issue, or open any other follow up issues to explain any technical problems or bugs they found. Thus we started with core app functionality (live questions, students asking questions) and moved towards extra features as the sprint went along.

**What worked and didnt work**

In terms of core of our app, we met that mandate in phase 3 as we got the core functionality of our product/MVP done. We set a number of features that the team thought of as bonus and we ran into alot of unexpected technical issues in developing some of these extra features. At the end of the day, we also realized that some of these features like prof's preparing a quiz to the class, takes away from the point of our product as we want to focus on the students being able to learn more by asking questions.

Therefore I would say that the overall basic functionality and premise of our product went smoothly according to plan, as a few days after our initial planning meeting, we got most of it ready to go. However because we treated the rest of our tasks more as bonus features then core functionality, I think we were more inclined to alter them and possibly cancel them. While some of these bonus tasks deserved to be cancelled, I think we could have implemented a bit more if we had taken the extra features more seriously as opposed to just being extra. So overall treating the extra features as a "bonus" in our sprint backlog, didnt work out too well and we should have assigned 1-2 people to only work on these tasks because the core functionality could have been implemented by less people.

**Improvement suggestions and interesting insights**
* Github issues did not really translate well with the entire group. In the future, github issues should just be used for bugs/design issues and overall code discussion.
 * One interesting insight, is the use of ZenHub. Our group noticed this too late in the phase, however its a neat extension to github that has real time taskboards, to display backlog's, to-do's etc.
 * I think the presentation of issues in this manner, would have made our sprint backlog overall more successfull.
* Our group wanted to use Slack much more this phase, but we still ended up using Facebook messenger more than we should have.
 * The facebook messenger conversation got too confusing when relating it to our sprint backlog
 * Once again Slack should have been the better choice because we can setup channels for certain features and keep discussion of our backlog much more organized.
* Have core functionality all in one backlog, and once those are all finished start adding extra features to the backlog.
 * Because we added so many extra features early on (even in phase2), they got lost and were put off until the end, where for some cases we didnt have enough time to tackle the respective technical problems.


