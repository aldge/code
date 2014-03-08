#include <stdio.h>
#include <string.h>
#include <stdlib.h>

int main(void)
{
    char *str = NULL;

    /* allocate memory for string */
    str = calloc(10, sizeof(char));

    printf("%ld\n",sizeof(str));
    printf("%ld\n",sizeof(int));
    printf("%ld\n",sizeof(char));
    /* copy "Hello" into string */
    strcpy(str, "Hellohellohello");
    printf("%ld\n",sizeof(str));

    /* display string */
    printf("String is %s\n", str);

    /* free memory */
    free(str);

    return 0;
} 
