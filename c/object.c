#include <stdio.h>
#include <stdlib.h>
#include <assert.h>
#include "object.h"
#include <string.h>

void Object_destroy(void *self)
{
   Object *obj=self;
   if(obj){
        if(obj->description)free(obj->description);
        free(obj);
   }
}

void Object_init(void *self)
{
    return 1;

}

void Object_new(size_t size,Object proto,char *direction)
{
    if(!proto.init)proto.init=Object_init;
    if(!proto.description)proto.description=Object_description;
    if(!proto.destroy)proto.destroy=Object_destroy;
    if(!proto.attack)proto.attack=Object_attack;
    if(!proto.move)proto.move=Object_move;

    Object *el=calloc(1,size);
    *el=proto;

    el->description=strdup(description);
    
    if(!el->init(el)){
        el->destroy(el);
        return NULL;
    }else{
        return el;
    }

}
