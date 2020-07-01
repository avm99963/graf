# Contributing
Hi there! If you want to contribute to build this alternative version of the Graf, you can do several things:

## Contribute with code
If you want to contribute by writing code, you can submit changes in [Gerrit](https://gerrit.avm99963.com/q/project:graf). You can learn the basics on how to do that by reading the following article: [Working with Gerrit: An example](https://gerrit.avm99963.com/Documentation/intro-gerrit-walkthrough.html)

All help is welcome, but please make sure to test your code before uploading the change. Also, try to follow the style of the code already written, which will make it look clean. These are some of the conventions we use (adapted from https://github.com/opengovernment/opengovernment/blob/master/CONTRIBUTING.md):

* We indent using two spaces (soft tabs)
* We generally put spaces after list items and method parameters (`[1, 2, 3]`, not `[1,2,3]`) and around operators (`x += 1`, not `x+=1`). Some exceptions are when using increment and decrement operators (e.g. `i++`) or when multiplying, dividing, and even sometimes when summing or subtracting two numbers (e.g. `a*b`), although sometimes spaces are added to sums and subtractions to make it clear that multiplication and division have higher precedence (e.g. `a + b*c`).
* This is open source software. Consider the people who will read your code, and make it look nice for them. It's sort of like driving a car: Perhaps you love doing donuts when you're alone, but with passengers the goal is to make the ride as smooth as possible.

### About CSS and JS files
For the sake of understandable code, we divide our JS scripts and CSS styles into multiples files.

Before, we concatenated all these JS and CSS files into two single files which were included into `graf.php`, but as we now have `modspeed` running in our server (an Apache mod which, apart from other things, can combine CSS and JS files when serving pages) and this procedure was complex and tiring, we no longer need to do this, so we are now including all JS and CSS files directly to the `graf.php` page for the sake of simplicity.

## Contribute filling in bug issues or feature requests
Did you find out something is not working, or do you have an awesome idea about the alternative Graf? It would be great if you filled in a [new issue](https://github.com/avm99963/graf/issues/new)! But just before you do that, check that [another issue](https://github.com/avm99963/graf/issues) about the same topic doesn't exist.
