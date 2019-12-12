SELECT time_to_sec(timediff('2019-12-12 09:00:00 pm',time_of_swap))/60 as timer,
IF(swaps.poster_user_id = 'xxx','true','false') as isMe,
statuslikes.user_id,swap_id,swaps.is_accepted,users.user_id as poster_user_id,swaped_with.user_id as swaped_with_user_id,users.name as poster_user_name,swaped_with.name as swaped_with_user_name,status,has_attachment,
attachments,swaps.status_id,swaps.created_at as swap_date,users.profile_image as poster_profile_image,
swaped_with.profile_image as swaped_with_profile_image,



(select count(*) from status_tags WHERE status_tags.status_id = statuses.`status_id`) as tag_count,
(select users.name from status_tags LEFT JOIN users on users.user_id = status_tags.`tagged_user_id` WHERE status_tags.status_id = statuses.`status_id` LIMIT 1) as first_tag,
(select avg(rattings.ratting) from rattings WHERE rattings.status_id = statuses.status_id) as avg_ratting,
(select count(*) from statuslikes WHERE statuslikes.`status_id` = statuses.`status_id`) as likes_count,
(select count(*) from statuslikes WHERE statuslikes.`status_id` = statuses.`status_id` AND statuslikes.`user_id` = 'xxx') as isLiked,

(select count(*) from status_shares WHERE status_shares.`status_id` = statuses.`status_id`) as shares_count,
(select count(*) from status_comments WHERE status_comments.`status_id` = statuses.`status_id`) as comments_count

FROM swaps 
LEFT JOIN users on users.user_id = `poster_user_id`
LEFT JOIN statuses on statuses.`status_id` = swaps.`status_id`
LEFT JOIN users as swaped_with on swaped_with.`user_id` = swaps.`swaped_with_user_id`
#LEFT JOIN rattings on rattings.`status_id` = swaps.`status_id`
/* LEFT JOIN statuslikes on statuslikes.`status_id` = swaps.`status_id`
LEFT JOIN status_shares on status_shares.`status_id` = swaps.`status_id`
LEFT JOIN status_comments on status_comments.`status_id` = swaps.`status_id` */


where (poster_user_id = 'xxx' and time_to_sec(timediff('2019-12-12 09:00:00 pm',time_of_swap))/60 > 30 and is_accepted = 1) or (swaped_with_user_id = 'xxx' and time_to_sec(timediff('2019-12-12 09:00:00 pm',time_of_swap))/60 > 30 and is_accepted = 1);