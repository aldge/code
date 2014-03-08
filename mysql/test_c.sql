CREATE TABLE `test_t` (     
`id` int(11) NOT NULL auto_increment,     
`num` int(11) NOT NULL default '0',     
`d_num` varchar(30) NOT NULL default '0',     
 PRIMARY KEY  (`id`)     
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `test_test` (     
  `id` int(11) NOT NULL auto_increment,     
  `num` int(11) NOT NULL default '0',     
  PRIMARY KEY  (`id`)     
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;  


delimiter |     
create procedure i_test(pa int(11),tab varchar(30))     
  begin     
      declare max_num int(11) default 100000;     
      declare i int default 0;     
      declare rand_num int;     
	  declare double_num char;     
      
   if tab != 'test_test' then     
          select count(id) into max_num from test_t;     
          while i < pa do    
              if max_num < 100000 then     
                  select cast(rand()*100 as unsigned) into rand_num;     
                  select concat(rand_num,rand_num) into double_num;     
                  insert into test_t(num,d_num)values(rand_num,double_num);     
              end if;     
              set i = i +1;     
          end while;     
   else    
          select count(id) into max_num from test_test;     
          while i < pa do    
              if max_num < 100000 then     
                  select cast(rand()*100 as unsigned) into rand_num;     
                  insert into test_test(num)values(rand_num);     
              end if;     
              set i = i +1;     
          end while;     
   end if;     
  end|
  