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
Optimized by: Brandi


Notes: 
To optimize this query
Index stage_name, native_name, movie_id, people_id
Index movie_people, people

(Index where, groupby, join statements)

Added LIMIT statement
*/


/*

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
LIMIT 1


/*
Optimized By: Xavier

*/

ALTER TABLE movie_people ADD INDEX (people_id, movie_id)
EXPLAIN SELECT native_name AS Movie, 
  stage_name AS Director, 
  gender 
  FROM movies 
    JOIN movie_people ON movies.movie_id = movie_people.movie_id 
      JOIN people ON movie_people.people_id = people.people_id WHERE (role = "Director" AND stage_name = "Takashi Shimizu") 
  GROUP BY movies.movie_id
LTER TABLE movie_people ADD INDEX (people_id, movie_id)

ALTER TABLE movie_people DROP INDEX movie_id
