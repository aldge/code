#include <stdio.h>

void MyFun(int);
//void (*FunP)(int);
typedef void (*FunType)(int);
int main(int argc,char *argv[])
{
	int a=20;
	//(*MyFun)(a);	
	//FunP=&MyFun;
	FunType FunP=MyFun;	
	FunP(a);
	return 0;
}

void MyFun(int x)
{
	printf("%d\n",x);
}
