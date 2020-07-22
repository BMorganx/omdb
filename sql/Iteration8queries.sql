
--Iteration 8 Query
SELECT native_name, box_office
FROM movies INNER JOIN movie_numbers
ON movies.movie_id = movie_numbers.movie_id
ORDER BY box_office DESC
LIMIT 3;


INSERT INTO `movie_numbers` (movie_id, running_time, length, strength, weight, budget, box_office)
VALUES ('1011', '92', NULL, NULL, NULL, '375270000', '392197464' );

INSERT INTO `movie_numbers` (movie_id, running_time, length, strength, weight, budget, box_office)
VALUES ('1', '119', NULL, NULL, NULL, '839727', '1594107' );

INSERT INTO `movie_numbers` (movie_id, running_time, length, strength, weight, budget, box_office)
VALUES ('2', '128', NULL, NULL, NULL, '2479000', '7796389' );

INSERT INTO `movie_numbers` (movie_id, running_time, length, strength, weight, budget, box_office)
VALUES ('7', '175', NULL, NULL, NULL, '6000000', '246120974' );
