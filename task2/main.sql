 SELECT worker.first_name, worker.last_name,
    GROUP_CONCAT(name) child_list,
    GROUP_CONCAT(DISTINCT car.model ) model_list
        FROM worker
        LEFT JOIN child ON child.user_id = worker.id
        LEFT JOIN car ON car.user_id = worker.id
        WHERE car.user_id is not null
        GROUP BY worker.first_name, worker.last_name;
