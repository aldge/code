#include <stdio.h>
#include <assert.h>
#include <stdlib.h>
#include <string.h>
 
struct Person
{
	char *name;	
	int age;
	int height;
	int weight;
};

struct Person *Person_create(char *name,int age,int height,int weight)
{
	struct Person *who=malloc(sizeof(struct Person));	
	assert(who!=NULL);
	
	who->name=strdup(name);
	who->age=age;
	who->height=height;
	who->weight=weight;
	
	return who;
}

void Person_destroy(struct Person *who)
{
	assert(who!=NULL);	
	
	free(who->name);
	free(who);
}

void Person_print(struct Person *who)
{
	printf("Name:%s\n",who->name);	
	printf("\tage:%d\n",who->age);
	printf("\theight:%d\n",who->height);
	printf("\tweight:%d\n",who->weight);
}

int main(int argc,char *argv[])
{
	struct Person *jack=Person_create("jack joe",20,180,160);
	struct Person *jim=Person_create("jim joe",22,170,180);
	
	printf("Jack is at memory location %p:\n",jack);
	Person_print(jack);
	
	printf("Jim is at memory location %p:\n",jim);
	Person_print(jim);


	jack->age+=3;
	jack->height-=2;
	jack->weight+=40;
	Person_print(jack);

	jim->age+=5;
	jim->height+=10;
	jim->weight-=6;

	Person_print(jim);

	Person_destroy(jack);
	Person_destroy(jim);
	return 0;
}
