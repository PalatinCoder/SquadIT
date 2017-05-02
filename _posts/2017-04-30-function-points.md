---
title:  "Function Point Estimation"
author: Rico
excerpt: Function points are used to estimate software project costs.
---
## Welcome Back!
Today we want to present you our function point estimation. We used the [FP calculator](http://groups.engin.umd.umich.edu/CIS/course.des/cis525/js/f00/harvey/FP_Calc.html) made by "Tiny Tools" to estimate our function points.

Our FP calculation can be found [here](https://github.com/PalatinCoder/SquadIT.WebApp/blob/master/Documentation/Functionpoints/FP_Calculation.pdf).

In the following diagram we connected our logged times with the function points:

![Screenshot]({{ site.url }}{{ site.baseurl }}/images/FP_estimate.png)

You can see that many points are quite far from the trend line. The reason for this is, that on the one hand our Framework (Flow) decreases the workload we have for many use cases (especially CRUDs). On the other hand some features which don't have many function points took a long time to implement (e.g. profile pictures).
