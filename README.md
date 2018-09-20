# iNominate

##Git Instructions

### Getting Started

To set up the git directory on your workstation follow these instructions:

1) Open a new Explorer Window
2) Right click and select "Git Bash here"
3) Copy or write the below line in the command window

```
git clone https://github.com/stefdworschak/iNominate.git
```

### Creating your own development branch

To check existing branches
```
git branch -a
```
To create your own branch (this should be a unique name)
```
git branch new_branch_name
```
To move to your new branch (same works for master)
```
git checkout new_branch_name
```

### Checking the status of your branch

```
git status
```

### Every time before starting to work

Before you start working on any new code pull the newest version of the master file.
If you forgot to merge your branch with the master, then this will overwrite your changes.

```
git pull origin master
```

### When you are finished with your changes

When working on code try to do this every so often in order to keep the repository updated

To add all modified files to git
```
git add .
git commit -am "Note what changes you made"
```

Once you have added all your files and commited your changes you want to merge your changes with the master branch
```
git checkout master
git merge new_branch_name
```

### Resolving Conflicts
If you and somebody else have modified the same line(s) of code there will be conflicts in the merge request.
In order to 
