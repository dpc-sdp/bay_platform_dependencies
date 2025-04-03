This patch adds support for NewRelic transactions when using the PhpRedisCluster.

This patch will only apply AFTER the patch from the drupal.org/node/2900947 issue.

The redis module maintainer has explicitly stated he doesnt want to maintain the cluster client, so we are basically cursed to constantly have to rebase this patch every time the drupal.org patch is rerolled.

I dont have a fast, easy, or automated way to do this rebase process. This is how I did it last time:

1. Checkout the redis module locally, on the version the most recent patch is against.
2. Apply the patch, commit.
3. Manually add the code for the newrelic transaction feature.
4. Commit
5. `git diff HEAD~1 > tide-redis-cluster-newrelic-VERSION.patch`
6. Put that patch file in this repo.