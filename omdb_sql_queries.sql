/*7.13 & 7.17 are missing due to absent students*/
/*
_____________________
7.14 -- Brandi

Description: Create movie_trivia  (assume movie_id and a bunch of trivia are given)*/

INSERT INTO `movie_trivia` (`movie_id`, `movie_trivia_id`, `movie_trivia_name`) VALUES(1, '234522', 'Example Movie trivia!');

/*
_____________________
7.15 -- Daniel

Description: Create movie_keywords (assume movie_id and a bunch of keywords are given)*/

INSERT INTO `movie_keywords` (movie_id, keyword) 
VALUES ('1',"Elections"),
('1',"Marriage"),
('1',"Scandal"),
('1',"Attempted Suicide"),
('1',"Memoirs"),
('1',"Rosebud");
/*
_____________________
7.16 -- Xavier

Description: Create movie_quotes (assume a movie_id and a bunch of quotes are given)*

INSERT INTO `movie_quotes` (movie_id, movie_quote_id, movie_quote_name) VALUES ('1011', '1', "Brother, stop playing this weird joke on me.");
/*
_____________________
7.33 --
Description: Connect all the tables from “movies” perspective; 

You should show ALL movies. Show NULLs if there is no corresponding movie_data or media or songs or people

The combined tuple should show the following.
*/

SELECT m.movie_id, 
       m.native_name, 
       m.english_name, 
       m.year_made,  
       movie_data.tag_line, 
       movie_data.language, 
       movie_data.country, 
       movie_data.genre, 
       movie_data.plot, 
       (SELECT Count(*) 
        FROM   movie_trivia 
        WHERE  m.movie_id = movie_trivia.movie_id) AS triviaCount, 
       (SELECT Count(*) 
        FROM   movie_keywords mk 
        WHERE  m.movie_id = mk.movie_id)           AS keywordCount, 
       (SELECT Count(*) 
        FROM   movie_media mm 
        WHERE  m.movie_id = mm.movie_id)           AS mediaCount, 
       (SELECT Count(*) 
        FROM   songs s, 
               movie_song ms 
        WHERE  s.song_id = ms.song_id 
               AND m.movie_id = ms.movie_id)       AS songs, 
       (SELECT Count(*) 
        FROM   people p, 
               movie_people mp 
        WHERE  p.people_id = mp.people_id 
               AND m.movie_id = mp.movie_id)       AS people 
FROM   movies m 
       LEFT JOIN (movie_data) 
              ON movie_data.movie_id = m.movie_id
              
              
              
/*
___________________________
Brandi 
8.45 --
Description: Given two stage names (this would be the input), give me the list of all movies in which both of them have some association.

Table will show the common movie among the two names.

*/

SELECT m.native_name 
FROM   movies m 
       INNER JOIN movie_people mp 
               ON mp.movie_id = m.movie_id 
       INNER JOIN people p 
               ON mp.people_id = p.people_id 
WHERE  p.stage_name IN ( 'Alfred Hitchcock', 'Kim Novak' ) 
GROUP  BY m.native_name 
HAVING Count(m.movie_id) > 2 
/*
___________________________
 
8.57 -- Daniel
Description: Give me the list of all movies that contain movie_media 
where m_link_type = “alt_poster”  If a movie doesn’t contain 
media or doesn’t contain alt_poster, do NOT show that 
movie in the result set*/

SELECT movies.native_name, 
       movie_media.m_link, 
       movie_media.m_link_type
FROM movies, 
     movie_media
WHERE movies.movie_id = movie_media.movie_id AND movie_media.m_link_type = 'poster'

/*
__________________________________
8.53 -- Xavier
Description: Give me the list of all songs based on a theme (“theme” is the input)
$theme is a generic php variable, could be anything
*/

SELECT *
FROM songs
WHERE theme = $theme;


/*
__________________________________
8.53 -- Xavier
Description: Give me the list of all songs based on a theme (“theme” is the input)
*/
--Iteration 8, Query 53 
--Returns a table of songs based on a theme
SELECT *
FROM songs 
WHERE theme = "";

/*
__________________________________
8.61 -- Xavier
Description: Returns the name and amount earned of the three highest grossing movies 
in order from highest to lowest
*/
SELECT native_name, box_office
FROM movies INNER JOIN movie_numbers
ON movies.movie_id = movie_numbers.movie_id
ORDER BY box_office DESC
LIMIT 3;



/*
Iteration 9
Description: Creates the data in the primary “movie” table as well as all related “weak” entities. 

*/
--Insert into movies
INSERT INTO `movies` (`movie_id`, `native_name`, `english_name`, `year_made`) VALUES
(2001, 'When a Stranger Calls', 'When a Stranger Calls', 2006);

INSERT INTO `movie_anagrams` (`movie_id`, `anagram`) VALUES
(2001, '');

INSERT INTO `movie_data` (`tag_line`, `movie_id`, `language`, `country`, `genre`, `plot`) VALUES
('Whatever You Do, Don't Answer The Phone', 2001, 'English', 'USA', 'Horror/Thriller', 'Jill Johnson, a young teenager, is asked to baby sit for a rich family in a massive 3 story house. The kids are sleeping, giving her no company until she gets a mysterious unknown call. When she finds out the caller is in the house, she fights for freedom. Can she escape and save the kids in time?');

INSERT INTO `movie_keywords` (`movie_id`, `keyword`) VALUES
(2001, 'cell phone'),
(2001, 'highschool'),
(2001, 'teenager'),
(2001, 'nightmare'),
(2001, 'babysitting');

INSERT INTO `movie_media` (`movie_media_id`, `m_link`, `m_link_type`, `movie_id`) VALUES
(20, 'https://www.youtube.com/watch?v=wVXCvuzw_Xw', 'video', 2001),
(21, 'When_A_Stranger_Calls.jpg', 'poster', 2001);

INSERT INTO `movie_numbers` (`movie_id`, `running_time`, `length`, `strength`, `weight`, `budget`, `box_office`) VALUES
(2001, 87, 24, 1, 1, 20, 35);

INSERT INTO `movie_quotes` (`movie_id`, `movie_quote_id`, `movie_quote_name`) VALUES
(2001, 8, 'Your blood all over me.');

INSERT INTO `movie_trivia` (`movie_id`, `movie_trivia_id`, `movie_trivia_name`) VALUES
(2001, 3, 'The front of the Mandrakis house was built at an unused reservoir; the interior was in a studio.'),
(2001, 4, 'Though the film is billed as a remake of the same-named 1979 film, it's actually only a remake of the first 20 minutes of it--the ones that made it a cult classic.');
(2001, 5, 'The voice of "Stacy", the unseen girl during the opening-credit sequence and victim of the killer that targets Jill, is that of director Simon West's 12-year-old daughter Lillie.')

/*Insert into people --*/

INSERT INTO `people` (`people_id`, `stage_name`, `first_name`, `middle_name`, `last_name`, `gender`, `image_name`) VALUES
(11, 'Simon West', 'Simon', '', 'West', 'Male', 'simon_west.jpg')
(12, 'Camilla Belle', 'Camilla', '', 'Belle', 'Female', 'Camilla_Belle.jpg'),
(13, 'Tommy Flanagan', 'Tommy', '', 'Flanagan', 'Male', 'Tommy_Flanagan.jpg'),
(14, 'Katie Cassidy', 'Katie', '', 'Cassidy', 'Female', 'katie_cassidy.jpg'),
(15, 'Tessa Thompson', 'Tessa', '', 'Thompson', 'Female', 'Tessa_Thompson.jpg'),
(16, 'Brian Geragh', 'Brian', '', 'Geragh', 'Male', 'Brian_Geragh.jpg');

INSERT INTO `people_trivia` (`people_id`, `people_trivia_id`, `people_trivia_name`) VALUES
(12, 6, 'Camilla Belle had to do two months of weight-training and learning how to run to prepare for the role of Jill.');

/* Insert into Songs */

INSERT INTO `songs` (`song_id`, `title`, `lyrics`, `theme`) VALUES
(3, 'Lock It', NULL, 'None');

INSERT INTO `song_keywords` (`song_id`, `keyword`) VALUES
(3, 'Unknown');

INSERT INTO `song_media` (`song_media_id`, `s_link`, `s_link_type`, `song_id`) VALUES
(6, NULL, 'None', 3);

INSERT INTO `song_people` (`song_id`, `people_id`, `role`) VALUES
(3, 17, 'Composer');

INSERT INTO `song_trivia` (`song_id`, `song_trivia_id`, `song_trivia_name`) VALUES
(3, 5, 'Joe Faraci wrote and performed the song in this movie');

