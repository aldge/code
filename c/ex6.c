#include <stdio.h>

int main(int argc,char *argv[])
{
    int distance=10;
    float power=2.345f;
    double super_power=56789.4532;
    char initial='A';
    char first_name[]="zhao";
    char last_name[]="huan";
    
    printf("You are %d miles away.\n",distance);
    printf("You have %f levels power.\n",power);
    printf("You have awesome %f super powers.\n",super_power);
    printf("I have an initial '%c'.\n",initial);
    printf("I have a first name %s.\n",first_name);
    printf("I have a last name %s .\n",last_name);
    printf("My whole name is %s  %c %s .\n",initial,first_name,last_name);
    return 0; 

}

