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



