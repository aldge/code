#!/usr/bin/python
##########################################################################
# split a file into a set of parts; join.py puts them back together;
# this is a customizable version of the standard unix split command-line 
# utility; because it is written in Python, it also works on Windows and
# can be easily modified; because it exports a function, its logic can 
# also be imported and reused in other applications;
##########################################################################
     
import sys, os
kilobytes = 1024
megabytes = kilobytes * 1000
chunksize = int(1.4 * megabytes)                   # default: roughly a floppy
     
def split(fromfile, todir, chunksize=chunksize): 
    if not os.path.exists(todir):                  # caller handles errors
        os.mkdir(todir)                            # make dir, read/write parts
    else:
        for fname in os.listdir(todir):            # delete any existing files
            os.remove(os.path.join(todir, fname)) 
    partnum = 0
    input = open(fromfile, 'rb')                   # use binary mode on Windows
    while 1:                                       # eof=empty string from read
        chunk = input.read(chunksize)              # get next part <= chunksize
        if not chunk: break
        partnum  = partnum+1
        filename = os.path.join(todir, ('part%04d' % partnum))
        fileobj  = open(filename, 'wb')
        fileobj.write(chunk)
        fileobj.close()                            # or simply open().write()
    input.close()
    assert partnum <= 9999                         # join sort fails if 5 digits
    return partnum
            
if __name__ == '__main__':
    if len(sys.argv) == 2 and sys.argv[1] == '-help':
        print 'Use: split.py [file-to-split target-dir [chunksize]]'
    else:
        if len(sys.argv) < 3:
            interactive = 1
            fromfile = raw_input('File to be split? ')       # input if clicked 
            todir    = raw_input('Directory to store part files? ')
        else:
            interactive = 0
            fromfile, todir = sys.argv[1:3]                  # args in cmdline
            if len(sys.argv) == 4: chunksize = int(sys.argv[3])
        absfrom, absto = map(os.path.abspath, [fromfile, todir])
        print 'Splitting', absfrom, 'to', absto, 'by', chunksize
     
        try:
            parts = split(fromfile, todir, chunksize)
        except:
            print 'Error during split:'
            print sys.exc_info()[0], sys.exc_info()[1]
        else:
            print 'Split finished:', parts, 'parts are in', absto
        if interactive: raw_input('Press Enter key') # pause if clicked
join_file.py

#!/usr/bin/python
##########################################################################
# join all part files in a dir created by split.py, to recreate file.  
# This is roughly like a 'cat fromdir/* > tofile' command on unix, but is 
# more portable and configurable, and exports the join operation as a 
# reusable function.  Relies on sort order of file names: must be same 
# length.  Could extend split/join to popup Tkinter file selectors.
##########################################################################
     
import os, sys
readsize = 1024
     
def join(fromdir, tofile):
    output = open(tofile, 'wb')
    parts  = os.listdir(fromdir)
    parts.sort()
    for filename in parts:
        filepath = os.path.join(fromdir, filename)
        fileobj  = open(filepath, 'rb')
        while 1:
            filebytes = fileobj.read(readsize)
            if not filebytes: break
            output.write(filebytes)
        fileobj.close()
    output.close()
     
if __name__ == '__main__':
    if len(sys.argv) == 2 and sys.argv[1] == '-help':
        print 'Use: join.py [from-dir-name to-file-name]'
    else:
        if len(sys.argv) != 3:
            interactive = 1
            fromdir = raw_input('Directory containing part files? ')
            tofile  = raw_input('Name of file to be recreated? ')
        else:
            interactive = 0
            fromdir, tofile = sys.argv[1:]
        absfrom, absto = map(os.path.abspath, [fromdir, tofile])
        print 'Joining', absfrom, 'to make', absto
     
        try:
            join(fromdir, tofile)
        except:
            print 'Error joining files:'
            print sys.exc_info()[0], sys.exc_info()[1]
        else:
           print 'Join complete: see', absto
        if interactive: raw_input('Press Enter key') # pause if clicked

