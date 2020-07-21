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
