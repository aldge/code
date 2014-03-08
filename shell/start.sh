#! /bin/sh
/usr/local/bin/fdfs_trackerd /etc/fastdfs/tracker.conf;
/usr/local/bin/fdfs_storaged  /etc/fastdfs/storage.conf;
/usr/local/bin/fdfs_storaged  /etc/fastdfs/storage2.conf;
/usr/local/bin/fdfs_storaged  /etc/fastdfs/storage3.conf;
/usr/local/nginx/sbin/nginx;
/usr/local/nginx/sbin/nginx start;