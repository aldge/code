#include <stdio.h>

void findl(char needle[],char search,char **p)
{
	int i=0;
	for(i=0;needle[i]!=0;i++)
	{
		if(needle[i]==search)		
		{
			*p=needle+i;
			break;	
		}else if(needle[i]==0){
			*p=0;
			break;
		}
	}	


}


int  main()
{
	/*
	int a=6,*p,**pp;
	p=&a;
	pp=&p;	
	printf("%d\n",**pp);	
	*/
	char needle[]={"asdfasdf\0"};
	char search='d';
	char *p=0;
	findl(needle,search,&p);	
	if(p==0)
	{
		printf("cannot find it.\n");	
	}else{
		printf("I find it p=%d.\n",*p);
	}
	
	return 0;
}	
